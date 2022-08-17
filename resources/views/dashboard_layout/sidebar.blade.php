<div class="min-height-300 bg-primary position-absolute w-100"></div>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
            <span class="ms-1 font-weight-bold">DNT Core Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div id="sidebar" class="collapse navbar-collapse  w-auto py-5" id="sidenav-collapse-main" style="height: inherit">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="m-0 p-0 ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <template v-for="(menu, index) in menus">
                <template v-if="menu.childs.length > 0">
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample1" href="#collapseExample1">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            <span class="nav-link-text ms-1">@{{ menu.name }}</span>
                        </a>
                        <ul class="navbar-nav collapse" id="collapseExample1">
                            <template v-for="(childMenu, childIndex) in menu.childs">
                                <li class="nav-item" style="padding-left:16px;">
                                    <a class="nav-link" :href="childMenu.path">
                                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                                        </div>
                                        <span class="nav-link-text ms-1">@{{ childMenu.name }}</span>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <a class="nav-link" :href="menu.path">
                            <i class="m-0 p-0 ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            <span class="nav-link-text ms-1">@{{ menu.name }}</span>
                        </a>
                    </li>
                </template>
            </template>
            <template v-for="(menu, index) in menus">
                <template v-if="menu.childs.length > 0">
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample1" href="#collapseExample1">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            <span class="nav-link-text ms-1">@{{ menu.name }}</span>
                        </a>
                        <ul class="navbar-nav collapse" id="collapseExample1">
                            <template v-for="(childMenu, childIndex) in menu.childs">
                                <li class="nav-item" style="padding-left:16px;">
                                    <a class="nav-link" :href="childMenu.path">
                                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                                        </div>
                                        <span class="nav-link-text ms-1">@{{ childMenu.name }}</span>
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <a class="nav-link" :href="menu.path">
                            <i class="m-0 p-0 ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            <span class="nav-link-text ms-1">@{{ menu.name }}</span>
                        </a>
                    </li>
                </template>
            </template>
            <li style="cursor: pointer" class="nav-item">
                <div @click="logout" class="nav-link">
                    <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Log Out</span>
                </div>
            </li>
        </ul>
    </div>
    <script>
        createApp({
            data() {
                return {
                    menus: []
                }
            },
            created() {
                this.fetchMenu()
            },
            methods: {
                async fetchMenu() {
                    try {
                        const response = await httpClient.get('/menu/mine');
                        this.menus = response.data.result;
                    } catch (err) {
                        showToast({
                            message: err.message,
                            type: 'warning'
                        })
                    }
                },
                async logout() {
                    showLoading()
                    try {
                        await httpClient.get("/user/logout")
                        location.href = "/user/login"
                    } catch (err) {
                        hideLoading()
                        showToast({
                            message: err.message,
                            type: 'warning'
                        })
                    }
                }
            },
        }).mount("#sidebar")
    </script>
</aside>