@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="jabatan">
    <default-datatable title="Jabatan" url="{!! url('jabatan') !!}" :headers="headers" :can-add="{{ $permissions['create-jabatan'] }}" :can-edit="{{ $permissions['update-jabatan'] }}" :can-delete="{{ $permissions['delete-jabatan'] }}" />
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
        						text: 'Nama Jabatan'
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
    }).mount('#jabatan');
</script>
@endsection