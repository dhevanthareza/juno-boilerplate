@extends('dashboard_layout.index')
@section('content')
    <div class="page-inner" id="app">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Module</h6>
            </div>
            <div class="card-body">
                <form ref="menu_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nama Module</label>
                                <input v-model="module.name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Deskripsi Module</label>
                                <input v-model="module.description" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-header">
                <h4 class="card-title">Menu Utama Modul</h6>
            </div>
            <div class="card-body">
                <form ref="menu_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nama Menu</label>
                                <input v-model="menu.name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Path</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">/</span>
                                    </div>
                                    <input v-model="menu.path" class="form-control" type="email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <input v-model="menu.description" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Parent</label>
                                <vue-multiselect v-model="menu.parent_id" :searchable="true" :options="menuParents" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pb-2 pr-4">
                <div class="d-flex justify-content-end">
                    <button type="button" @click="back" class="btn btn-sm bg-warning mr-1 text-white">
                        Cancel
                    </button>
                    <button type="button" @click="store" class="btn btn-sm bg-primary mr-1 text-white">
                        Save Data
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        createApp({
            data() {
                return {
                    module: {
                        name: null,
                        description: null
                    },
                    menu: {
                        name: null,
                        path: null,
                        description: null,
                        parent_id: null
                    },
                    menuParents: [{
                        value: null,
                        label: "No Parent"
                    }]
                }
            },
            watch: {
                'module.name'(value) {
                    this.menu.path = value.toLowerCase().split(" ").join("-")
                }
            },
            created() {
                this.fetchMenuParents()
            },
            methods: {
                async fetchMenuParents() {
                    const response = await httpClient.get("{!! url('menu/parents') !!}")
                    this.menuParents = [
                        ...this.menuParents,
                        ...response.data.result.map(el => {
                            return {
                                value: el.id,
                                label: el.name
                            }
                        })
                    ]
                },
                back() {
                    history.back()
                },
            },
            components: {
                'vue-multiselect': VueformMultiselect
            },
        }).mount('#app');
    </script>
@endsection
