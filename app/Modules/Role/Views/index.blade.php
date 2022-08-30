@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="role-page">
    <default-datatable title="Role" url="{!! url('role') !!}" :headers="headers" />
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