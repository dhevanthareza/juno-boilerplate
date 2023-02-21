@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="user-pref">
    <default-datatable title="UserPref" url="{!! url('user-pref') !!}" :headers="headers" />
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
        
						text: 'tes_string',
        
						value: 'Tes String'
    
						},    
						{
        
						text: 'tes_double',
        
						value: 'Tes Double'
    
						},    
						{
        
						text: 'tes_decimal',
        
						value: 'Tes Decimal'
    
						},    
						{
        
						text: 'tes_text',
        
						value: 'Tes Text'
    
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