@extends('dashboard_layout.index')
@section('content')
<div class="page-inner">
    <div id="add-jabatan" class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Tambah Jabatan</h4>
            </div>
        </div>
        <div class="card-body">
            <form ref="jabatan_form">
                <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nama Jabatan</label>
                        <input v-model="jabatan.name" class="form-control" type="text">
                    </div>
                </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" @click="back" class="btn btn-sm bg-warning mr-2 text-white">
                        Cancel
                    </button>
                    <button type="button" @click="store" class="btn btn-sm bg-primary mr-2 text-white">
                        Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    Vue.createApp({
        data() {
            return {
                jabatan: {
					name: null,

                },
                selectOptions: [
                    {
                        value: 1,
                        label: "Yes" 
                    },
                    {
                        value: 0,
                        label: "No"
                    }
                ],
                radioOptions: [
                    {
                        id: 1,
                        label: "Yes"
                    },
                    {
                        id: 0,
                        label: "No"
                    }
                ],
            }
        },
        methods: {
            back() {
                history.back()
            },
            resetForm(){
                this.jabatan = {
					name: null,
              }
                this.$refs.jabatan_form.reset()
            },
            async store() {
                try {
                    showLoading()
                    const response = await httpClient.post("{!! url('jabatan') !!}", this.jabatan)
                    hideLoading()
                    showToast({
                        message: "Data berhasil ditambahkan"
                    })
                    this.resetForm()
                } catch (err) {
                    hideLoading()
                    showToast({
                        message: err.message,
                        type: 'error'
                    })
                }
            }
        },
        components: {
            'vue-multiselect': VueformMultiselect
        },
    }).mount("#add-jabatan")
</script>
@endsection