@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="laptop">
    <default-datatable title="Laptop" url="{!! url('laptop') !!}" :headers="headers" :can-add="{{ $permissions['create-laptop'] }}" :can-edit="{{ $permissions['update-laptop'] }}" :can-delete="{{ $permissions['delete-laptop'] }}" />
</div>

<script>
    createApp({
        data() {
            return {
                headers: [
                    {
                        text: 'Id',
                        value: 'id',
                    },    
					{
        						value: 'name',
        						text: 'Nama'
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
    }).mount('#laptop');
</script>
@endsection