@extends('dashboard_layout.index')
@section('content')
    <div class="page-inner">
        <div id="employee-page" class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Upload</h4>
                </div>
            </div>
            <div class="card-body">
                <form ref="employee_form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">NIP</label>
                                <input v-model="employee.nip" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">FullName</label>
                                <input v-model="employee.fullname" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">DOB</label>
                                <input v-model="employee.dob" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Address</label>
                                <input v-model="employee.address" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">File</label>
                                <input class="form-control" type="file" @change="handleFileChange">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">KTP</label>
                                <input class="form-control" type="file" @change="handleKtpChange">
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
                    employee: {
                        nip: null,
                        fullname: null,
                        dob: null,
                        address: null,
                        photo: null,
                        ktp_photo: null,
                    }
                }
            },
            methods: {
                handleFileChange(event) {
                    this.employee.photo = event.target.files[0];
                },
                handleKtpChange(event) {
                    this.employee.ktp_photo = event.target.files[0];
                },
                back() {
                    history.back()
                },
                async store() {
                    const employeeFormData = new FormData()
                    Object.keys(this.employee).forEach(key => {
                        employeeFormData.append(key, this.employee[key])
                    });
                    try {
                        showLoading()
                        const response = await httpClient.post("{!! url('employee') !!}", employeeFormData)
                        hideLoading()
                        showToast({
                            message: "Data berhasil ditambahkan"
                        })
                        this.$refs.employee_form.reset()
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
                'vue-multiselect': VueformMultiselect,
                'date-picker': VueDatePicker
            }
        }).mount("#employee-page")
    </script>
@endsection
