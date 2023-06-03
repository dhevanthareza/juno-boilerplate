@extends('dashboard_layout.index')
@section('content')
<div class="page-inner">
    <div id="edit-shift" class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Tambah Shift</h4>
            </div>
        </div>
        <div class="card-body">
            <form ref="shift_form">
                <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input v-model="shift.name" class="form-control" type="text">
                    </div>
                </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" @click="back" class="btn btn-sm bg-warning mr-2 text-white">
                        Cancel
                    </button>
                    <button type="button" @click="update" class="btn btn-sm bg-primary mr-2 text-white">
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
                shift: {
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
        async created() {
            showLoading()
            await this.fetchData()
            hideLoading()
        },
        methods: {
            async fetchData() {
                const response = await httpClient.get("{!! url('shift') !!}/{{ $shift_id }}")
                this.shift = response.data.result
                console.log(this.shift)
            },
            back() {
                history.back()
            },
            async update() {
                try {
                    showLoading()
                    const response = await httpClient.put("{!! url('shift') !!}/{{ $shift_id }}",
                        this.shift)
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
        components: {
            'vue-multiselect': VueformMultiselect
        },
    }).mount("#edit-shift")
</script>
@endsection