<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                {{-- <div class="avatar-sm float-left mr-2">
                </div> --}}
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul id="sidebar" class="nav nav-primary">
                <template v-for="(menu, index) in menus">
                    <template v-if="menu.childs.length > 0">
                        <li :class="`nav-item ${ activeParentMenu == menu.name ? 'active' : ''}`" @click="setActiveParentMenu(menu.name)">
                            <a data-toggle="collapse" :href="`#${menu.name.split('').join('')}`">
                                <i class="fas fa-home"></i>
                                <p>@{{ menu.name }}</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" :id="menu.name.split('').join('')">
                                <ul class="nav nav-collapse">
                                    <template v-for="(childMenu, childIndex) in menu.childs">
                                        <li :class="`${ activeMenu == childMenu.name ? 'active' : ''}`" @click="setActiveMenu(childMenu.name)">
                                            <a :href="`/${childMenu.path}`">
                                                <span :href="`/${childMenu.path}`" class="sub-item">@{{ childMenu.name }}</span>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <a :href="menu.path">
                                <i class="fas fa-layer-group"></i>
                                <p>@{{ menu.name }}</p>
                                <span class="caret"></span>
                            </a>
                        </li>
                    </template>
                </template>
            </ul>
        </div>
    </div>
    <script>
        createApp({
            data() {
                return {
                    menus: [],
                    activeMenu: '',
                    activeParentMenu: ''
                }
            },
            created() {
                this.fetchMenu()
            },
            methods: {
                setActiveMenu(activeMenu) {
                    this.activeMenu = activeMenu
                },
                setActiveParentMenu(activeMenu) {
                    this.activeParentMenu = activeMenu
                },
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
</div>
