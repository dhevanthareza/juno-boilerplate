let render; //RenderFunction | undefined
let pending; //AbortController | undefined
let listeners = []; //NavigationListener[]
let blockers = []; //(() => boolean | Promise<boolean>)[]
let nextIndex = 0
let currentUrl; //string
let lastRenderedId; //string
let lastRenderedIndex; //number
let savedScrollRestoration; //ScrollRestoration
let base; // HTMLBaseElement

let blocking = false;
let ignoring = false;
let redoing = false;

// | {
//     delta: number;
//     href: string;
//     state: any;
// }
// | undefined
let lastCanceled;

// ((result: boolean) => void) | undefined
let pendingResolver;

//  (() => void) | undefined
let cancelResolver;

function initialize({ renderFunction, isInstallGlobalHandler }) {
    if (render) {
        throw new Error("Client Side Navigator already initialized");
    }

    render = renderFunction;
    currentUrl = location.href;
    nextIndex = 0;
    savedScrollRestoration = history.scrollRestoration;
    history.scrollRestoration = "manual";

    addEventListener("popstate", handleNavigation);

    // Pertanyaan ??
    base = document.head.querySelector("coreroot");
    console.log(base)
    if (!base) {
        base = document.createElement("coreroot");
        document.head.insertBefore(base, document.head.firstChild);
    }
    base.href = location.href;

    if (isInstallGlobalHandler) {
        document.body.addEventListener("click", handleClick);
    }

    lastRenderedId = createUniqueId();
    lastRenderedIndex = nextIndex++;

    history.replaceState(
        { id: lastRenderedId, index: lastRenderedIndex },
        "",
        location.href,
    );
}

function finalize() {
    removeEventListener("popstate", handleNavigation);
    render = undefined;
    history.scrollRestoration = savedScrollRestoration;
    listeners = [];
    blockers = [];
    pending = undefined;
}

function handleClick(e) {
    if (!shouldHandleClick(e)) return;

    e.preventDefault();

    navigate(e.target.href);
}

function shouldHandleClick(e) {
    const t = e.target;

    return (
        (t instanceof HTMLAnchorElement ||
            t instanceof SVGAElement ||
            t instanceof HTMLAreaElement) &&
        !e.defaultPrevented &&
        t.href !== undefined &&
        e.button === 0 &&
        !e.shiftKey &&
        !e.altKey &&
        !e.ctrlKey &&
        (!t.target || t.target !== "_self") &&
        !t.hasAttribute("download") &&
        !t.relList.contains("external")
    );
}

function navigate(
    to,
    options,
) {
    if (!render) {
        throw new Error("Knave not initialized");
    }

    const url = new URL(to, location.href);

    if (url.origin !== location.origin) {
        location.href = url.href;
        return new Promise(() => { });
    }

    const { replace, scroll, data } = options || {};
    const id = createUniqueId();

    if (replace) {
        history.replaceState({ id, data, index: history.state.index }, "", to);
    } else {
        const index = nextIndex++;
        history.pushState({ id, data, index }, "", to);
    }

    return handleNavigation(undefined, scroll);
}

function handleBeforeUnload(e) {
    // Cancel the event
    e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
    // Chrome requires returnValue to be set
    e.returnValue = "";
}

function ignoreNavigation() {
    ignoring = true;
    history.go(lastRenderedIndex - history.state.index);
}

function cancelNavigation() {
    lastCanceled = {
        delta: lastRenderedIndex - history.state.index,
        href: location.href,
        state: history.state,
    };

    return new Promise((resolve) => {
        cancelResolver = resolve;

        history.go(lastCanceled?.delta);

        if (scroll !== undefined) {
            nextIndex--;
        }
    });
}

function redoNavigation() {
    redoing = true;
    history.go(-lastCanceled.delta);
}

async function handleNavigation(_, scroll = true) {
    console.log('handle navigation')
    if (ignoring) {
        ignoring = false;
        return false;
    }

    if (cancelResolver) {
        cancelResolver();
        cancelResolver = undefined;
        return false;
    }

    if (redoing && lastCanceled) {
        history.replaceState(lastCanceled.state, "", lastCanceled.href);
    }

    if (blocking) {
        ignoreNavigation();
        return false;
    }

    if (!redoing && blockers.length) {
        redoing = false;
        blocking = true;

        await cancelNavigation();

        const result = await callNavigationBlockers();

        blocking = false;

        if (!result) {
            pendingResolver?.(false);
            pendingResolver = undefined;
            return false;
        }

        redoNavigation();
        return new Promise((resolve) => (pendingResolver = resolve));
    }

    redoing = false;

    // Save scroll position
    const scrollPosition = { x: scrollX, y: scrollY };
    sessionStorage.setItem(
        `knave:${lastRenderedId}`,
        JSON.stringify(scrollPosition),
    );

    // Abort any pending navigation
    if (pending) pending.abort();

    // Render new page
    const controller = new AbortController();

    const result = render(controller.signal);

    if (isPromise(result)) {
        pending = controller;
        listeners.forEach((f) => f({ currentUrl, pendingUrl: location.href }));

        return result.then(() => {
            pending = undefined;
            if (controller.signal.aborted) {
                pendingResolver?.(false);
                pendingResolver = undefined;
                return false;
            }

            currentUrl = location.href;
            console.log(location.href)
            listeners.forEach((f) => f({ currentUrl }));

            if (scroll) restoreScrollPosition();

            lastRenderedId = history.state.id;
            lastRenderedIndex = history.state.index;
            base.href = location.href;
            pendingResolver?.(true);
            pendingResolver = undefined;
            return true;
        });
    } else {
        currentUrl = location.href;

        // LOADING PAGE
        const page = await httpClient.get(currentUrl, {
            params: {
                just_content: true
            }
        });
        setInnerHTML(document.getElementById("coreroot"), page.data)


        listeners.forEach((f) => f({ currentUrl }));
        if (scroll) restoreScrollPosition();

        lastRenderedId = history.state.id;
        lastRenderedIndex = history.state.index;
        base.href = location.href;
        pendingResolver?.(true);
        pendingResolver = undefined;
        return true;
    }
}

function addNavigationListener(listener) {
    listeners.push(listener);
}

function removeNavigationListener(listener) {
    listeners = listeners.filter((l) => l !== listener);
}

function addNavigationBlocker(
    blocker
) {
    blockers.push(blocker);
    if (blockers.length === 1 && render) {
        addEventListener("beforeunload", handleBeforeUnload);
    }
}

function removeNavigationBlocker(
    blocker
) {
    blockers = blockers.filter((b) => b !== blocker);
    if (blockers.length === 0) {
        removeEventListener("beforeunload", handleBeforeUnload);
    }
}

async function callNavigationBlockers() {
    for (const blocker of blockers) {
        let result = true;

        try {
            result = await blocker();
        } catch { }

        if (!result) return false;
    }

    return true;
}

function restoreScrollPosition() {
    const scrollPosition = sessionStorage.getItem(`knave:${history.state?.id}`);

    if (scrollPosition) {
        const { x, y } = JSON.parse(scrollPosition);
        scrollTo(x, y);
    } else {
        const hash = location.hash;
        if (hash) {
            const element = document.querySelector(hash);
            if (element) {
                element.scrollIntoView();
            }
        } else {
            scrollTo(0, 0);
        }
    }
}

function createUniqueId() {
    return Math.random().toString(36).substr(2, 9);
}

function isPromise(value) {
    return value && typeof value.then === "function";
}

initialize({
    isInstallGlobalHandler: true, renderFunction: () => {

    }
})

var setInnerHTML = (elm, html) => {
    elm.innerHTML = html;

    Array.from(elm.querySelectorAll("script")).forEach(oldScript => {
        const newScript = document.createElement("script");
        Array.from(oldScript.attributes)
            .forEach(attr => {
                console.log(attr)
                newScript.setAttribute(attr.name, attr.value)
            });
        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
        oldScript.parentNode.replaceChild(newScript, oldScript);
    });
}