@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="shift">
    <default-datatable title="Shift" url="{!! url('shift') !!}" :headers="headers" :can-add="{{ $permissions['create-shift'] }}" :can-edit="{{ $permissions['update-shift'] }}" :can-delete="{{ $permissions['delete-shift'] }}" />
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
        						text: 'Name'
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
    }).mount('#shift');
</script>
@endsection