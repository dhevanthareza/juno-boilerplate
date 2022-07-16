@extends('dashboard_layout.index')

@section('content')

<div id="app">

    <div class="row">
        <div class="col-12">
            <default-datatable url="{!! url('employee') !!}" :headers="headers" />
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
                headers: [{
                        text: 'id',
                        value: 'id',
                        align: 'center'
                    },
                    {
                        text: 'nip',
                        value: 'nip',
                    },
                    {
                        text: 'fullname',
                        value: 'fullname',
                    },
                    {
                        text: 'dob',
                        value: 'dob',
                    },
                    {
                        text: 'address',
                        value: 'address',
                    },
                    {
                        text: 'photo',
                        value: 'photo',
                    },
                ],
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