@extends('dashboard_layout.index')
@section('content')
<div id="add-role" class="card">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center">
            <h6 class="mb-0">Tambah Role</h6>
        </div>
    </div>
    <div class="card-body">
        <form ref="menu_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Role</label>
                        <input v-model="roleData.name" class="form-control" type="text">
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
                roleData: {
                    name: null,
                }
            }
        },
        methods: {
            back() {
                history.back()
            },
            async store() {
                try {
                    showLoading()
                    const response = await httpClient.post("{!! url('role') !!}", this.roleData)
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
    }).mount("#add-role")
</script>
@endsection