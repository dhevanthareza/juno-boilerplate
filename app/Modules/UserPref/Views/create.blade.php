@extends('dashboard_layout.index')
@section('content')
<div class="page-inner">
    <div id="add-user-pref" class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Tambah UserPref</h4>
            </div>
        </div>
        <div class="card-body">
            <form ref="user_pref_form">
                <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">nama UserPref</label>
                        <input v-model="user_pref.name" class="form-control" type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Level UserPref</label>
                        <input v-model="user_pref.level" class="form-control" type="number">
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
                user_pref: {
					name: null,
					level: null,

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
                    const response = await httpClient.post("{!! url('user-pref') !!}", this.user_pref)
                    hideLoading()
                    showToast({
                        message: "Data berhasil ditambahkan"
                    })
                    this.$refs.user_pref_form.reset()
                } catch (err) {
                    hideLoading()
                    showToast({
                        message: err.message,
                        type: 'error'
                    })
                }
            }
        },
    }).mount("#add-user-pref")
</script>
@endsection