@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="tes-menu">
    <default-datatable title="TesMenu" url="{!! url('tes-menu') !!}" :headers="headers" :can-add="{{ $permissions['create-tes_menu'] }}" :can-edit="{{ $permissions['update-tes_menu'] }}" :can-delete="{{ $permissions['delete-tes_menu'] }}" />
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
					{
        						value: 'level',
        						text: 'Level'
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
    }).mount('#tes-menu');
</script>
@endsection