@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="user-pref">
    <default-datatable title="UserPref" url="{!! url('user-pref') !!}" :headers="headers" :can-add="{{ $permissions['create-user_pref_menu'] }}" :can-edit="{{ $permissions['update-user_pref_menu'] }}" :can-delete="{{ $permissions['delete-user_pref_menu'] }}" />
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
    }).mount('#user-pref');
</script>
@endsection