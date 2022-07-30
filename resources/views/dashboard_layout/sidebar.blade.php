<div class="min-height-300 bg-primary position-absolute w-100"></div>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
            <span class="ms-1 font-weight-bold">DNT Core Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div id="sidebar" class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="m-0 p-0 ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style="background-color:#f6f9fc;">
                <a class="nav-link " data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample1" href="#collapseExample1">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Modul menu collapse</span>
                </a>
                <ul class="navbar-nav collapse" id="collapseExample1">
                    <li class="nav-item" style="padding-left:16px;">
                        <a class="nav-link active" href="#">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Sub Modul 1</span>
                        </a>
                    </li>
                    <li class="nav-item" style="padding-left:16px;">
                        <a class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample1sub" href="#collapseExample1sub">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Sub Modul 2</span>
                        </a>
                        <ul class="navbar-nav collapse" id="collapseExample1sub">
                            <li class="nav-item" style="padding-left:16px;">
                                <a class="nav-link" href="#">
                                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Sub Sub Modul</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/employee">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Employee</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/virtual-reality.html">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Virtual Reality</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/rtl.html">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="../pages/profile.html">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li style="cursor: pointer" class="nav-item">
                <div @click="logout" class="nav-link">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </div>
            </li>
        </ul>
    </div>
    <script>
        createApp({
            created() {
                this.fetchMenu()
            },
            methods: {
                async fetchMenu() {
                    try {
                        const response = await httpClient.get('/menu/mine');
                        console.log(response.data)
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