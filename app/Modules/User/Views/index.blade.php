@extends('dashboard_layout.index')
@section('content')
<div id="user-page">
    <default-datatable title="User" url="{!! url('user') !!}" :headers="headers" />
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
                        text: 'Nama User',
                        value: 'name',
                    },
                    {
                        text: 'Username User',
                        value: 'username',
                    },
                    {
                        text: 'Email User',
                        value: 'email',
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
    }).mount('#user-page');
</script>
@endsection