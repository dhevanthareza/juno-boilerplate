@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="app">
    <default-datatable title="Module" url="{!! url('module') !!}" :headers="headers" />
</div>

<script>
    createApp({
        data() {
            return {
                headers: [
                    {
                        text: 'id',
                        value: 'id',
                        align: 'center'
                    },
                    {
                        text: 'Nama Module',
                        value: 'name',
                    },
                ],
            }
        },
        created() {},
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