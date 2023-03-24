@extends('dashboard_layout.index')
@section('content')
    <div class="page-inner">
        <div id="add-user-pref" class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Tambah Employee</h4>
                </div>
            </div>
            <div class="card-body">
                <form ref="employee_form">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Nama</label>
                                <input v-model="employee.name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Level</label>
                                <input v-model="employee.level" class="form-control" type="number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Lahir</label>
                                <date-picker v-model="employee.dob" type="number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">FOTO KTP</label>
                                <input class="form-control" type="file" @change="handleFileChange">
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
                    employee: {
                        name: null,
                        level: null,
                        dob: null,
                        ktp_photo: null
                    },
                }
            },
            methods: {
                back() {
                    history.back()
                },
                resetForm() {
                    this.employee = {
                        name: null,
                        level: null,
                        dob: null,
                        ktp_photo: null
                    }
                    this.$refs.employee_form.reset()
                },
                handleFileChange(event) {
                    this.employee.ktp_photo = event.target.files[0];
                },
                async store() {
                    try {
                        showLoading()
                        let employeeFormData = new FormData()
                        Object.keys(this.employee).forEach(key => {
                            employeeFormData.append(key, this.employee[key])
                        });
                        const response = await httpClient.post("{!! url('employee') !!}", employeeFormData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
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
                'vue-multiselect': VueformMultiselect,
                'date-picker': VueDatePicker
            },
        }).mount("#add-user-pref")
    </script>
@endsection
