@extends('dashboard_layout.index')
@section('content')
<div id="role-page">
    <default-datatable title="Menu" url="{!! url('menu') !!}" :headers="headers" />
</div>

<script>
    createApp({
        data() {
            return {
                headers: [{
                        text: 'id',
                        value: 'id',
                    },
                    {
                        text: 'Nama Role',
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
    }).mount('#role-page');
</script>
@endsection