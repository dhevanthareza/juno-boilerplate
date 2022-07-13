@extends('dashboard_layout.index')

@section('content')

<div id="app">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Employee</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <default-datatable url="{!! url('employee') !!}" :headers="headers">
                        </default-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const {
        createApp
    } = Vue;

    createApp({
        data() {
            return {
                headers: ['id', 'nip', 'fullname', 'dob', 'address', 'photo'],
            }
        },
        methods: {},
        components: {
            ...commonComponentMap(
                [
                    'DefaultDatatable',
                ]
            )
        },
    }).mount('#app');
</script>

@endsection