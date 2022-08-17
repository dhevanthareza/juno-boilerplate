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
                        <input v-model="name" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Path</label>
                        <input v-model="path" class="form-control" type="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Description</label>
                        <input v-model="description" class="form-control" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Parent</label>
                        <vue-multiselect v-model="parent_id" :searchable="true" :options="parents" />
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" @click="back" class="btn btn-xs bg-warning me-1 text-white">
                    Cancel
                </button>
                <button type="button" @click="store" class="btn btn-xs bg-primary me-1 text-white">
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
                name: null,
                path: null,
                description: null,
                parent_id: null,
                parents: [{
                    value: null,
                    label: "No Parent"
                }]
            }
        },
        created() {
            this.fetchParents()
        },
        methods: {
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
            async store() {
                try {
                    showLoading()
                    const {
                        name,
                        path,
                        description,
                        parent_id
                    } = this
                    const response = await httpClient.post("{!! url('menu') !!}", {
                        name,
                        path,
                        description,
                        parent_id
                    })
                    hideLoading()
                    showToast({
                        message: "Data berhasil ditambahkan"
                    })
                    this.$refs.menu_form.reset()

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