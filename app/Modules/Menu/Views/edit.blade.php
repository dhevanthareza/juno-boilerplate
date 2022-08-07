@extends('dashboard_layout.index')
@section('content')
<div id="add-menu" class="card">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center">
            <h6 class="mb-0">Tambah Menu</h6>
        </div>
    </div>
    <div class="card-body">
        <form ref="menu_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Menu</label>
                        <input v-model="menuData.name" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Path</label>
                        <input v-model="menuData.path" class="form-control" type="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Description</label>
                        <input v-model="menuData.description" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Parent</label>
                        <vue-multiselect v-model="menuData.parent_id" :searchable="true" :options="parents" />
                    </div>
                </div>
            </div>
            <template v-if="false">
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Contact Information</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Address</label>
                            <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">City</label>
                            <input class="form-control" type="text" value="New York">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Country</label>
                            <input class="form-control" type="text" value="United States">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Postal code</label>
                            <input class="form-control" type="text" value="437300">
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">About me</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">About me</label>
                            <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
                        </div>
                    </div>
                </div>
            </template>
            <div class="d-flex justify-content-end">
                <button type="button" @click="back" class="btn btn-xs bg-warning me-1 text-white">
                    Cancel
                </button>
                <button type="button" @click="update" class="btn btn-xs bg-primary me-1 text-white">
                    Save Data
                </button>
            </div>
        </form>

    </div>
</div>
<script>
    Vue.createApp({
        data() {
            return {
                menuData: {
                    name: null,
                    path: null,
                    description: null,
                    parent_id: null,
                },
                parents: [{
                    value: null,
                    label: "No Parent"
                }]
            }
        },
        async created() {
            showLoading()
            await this.fetchParents()
            await this.fetchData()
            hideLoading()
        },
        methods: {
            async fetchData() {
                const response = await httpClient.get("{!! url('menu') !!}/{{ $menu_id }}/detail")
                this.menuData = response.data.result
                console.log(this.menuData)
            },
            async fetchParents() {
                const response = await httpClient.get("{!! url('menu/parents') !!}")
                this.parents = [
                    ...this.parents,
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
            async update() {
                try {
                    showLoading()
                    const response = await httpClient.put("{!! url('menu') !!}/{{ $menu_id }}", this.menuData)
                    hideLoading()
                    showToast({
                        message: "Data berhasil disimpan"
                    })

                } catch (err) {
                    hideLoading()
                    showToast({
                        message: err.message,
                        type: 'error'
                    })
                }
            }
        },
    }).component('vue-multiselect', VueformMultiselect).mount("#add-menu")
</script>
@endsection