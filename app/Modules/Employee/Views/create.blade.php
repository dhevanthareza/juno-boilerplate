@extends('dashboard_layout.index')
@section('content')
<div class="page-inner">
<div id="upload-test" class="card">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center">
            <h4 class="card-title">Upload</h4>
        </div>
    </div>
    <div class="card-body">
        <form ref="user_form" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">NIP</label>
                        <input v-model="upload.nip" class="form-control" type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">FullName</label>
                        <input v-model="upload.fullname" class="form-control" type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">DOB</label>
                        <input v-model="upload.dob" class="form-control" type="date">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Address</label>
                        <input v-model="upload.address" class="form-control" type="text">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">File</label>
                        <input ref="upload.photo" v-model="upload.photo" class="form-control" type="file" @change="handleFileUpload('upload.photo')">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" @click="back" class="btn btn-sm bg-warning me-1 text-white">
                    Cancel
                </button>
                <button type="button" @click="store" class="btn btn-sm bg-primary me-1 text-white">
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
                upload: {
                    nip: null,
                    fullname: null,
                    dob: null,
                    address: null,
                    photo: null,
                }
            }
        },
        methods: {
            handleFileUpload(ref){
                const propertyPath = ref.split('.');
                const propertyObj = this[propertyPath[0]];
                propertyObj[propertyPath[1]] = this.$refs[ref].files[0];
            },
            back() {
                history.back()
            },
            async store() {
                const formData = new FormData()
                for(key in this.upload){
                    formData.append(key, this.upload[key]);
                }
                try {
                    showLoading()
                    const response = await httpClient.post("{!! url('employee') !!}", formData)
                    hideLoading()
                    showToast({
                        message: "Data berhasil ditambahkan"
                    })
                    this.$refs.user_form.reset()

                } catch (err) {
                    hideLoading()
                    showToast({
                        message: err.message,
                        type: 'error'
                    })
                }
            }
        },
    }).mount("#upload-test")
</script>
@endsection