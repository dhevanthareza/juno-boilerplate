@extends('dashboard_layout.index')
@section('content')
<div class="page-inner" id="app">
    <div class="row">
        <div class="col-12">
            <default-datatable url="{!! url('employee') !!}" :headers="headers">
                <template #dob="{ content }">
                    <span class="badge badge-sm bg-gradient-success">@{{ content.dob }}</span>
                </template>
                <template #photo="{ content }">
                    <img width="100" :src="content.photo_url" />
                </template>
                <template #ktp_photo="{ content }">
                    <img width="100" :src="content.ktp_photo_url" />
                </template>
            </default-datatable>
        </div>
    </div>
</div>

<script type="module"> 
    Vue.createApp({
        data() {
            return {
                headers: [{
                        text: 'id',
                        value: 'id',
                        align: 'center'
                    },
                    {
                        text: 'nip',
                        value: 'nip',
                    },
                    {
                        text: 'fullname',
                        value: 'fullname',
                        sortable: true
                    },
                    {
                        text: 'dob',
                        value: 'dob',
                        sortable: true
                    },
                    {
                        text: 'address',
                        value: 'address',
                    },
                    {
                        text: 'photo',
                        value: 'photo',
                    },
                    {
                        text: 'ktp photo',
                        value: 'ktp_photo',
                    },
                ],
            }
        },
        created() {},
        methods: {},
        components: {
            'default-datatable': DefaultDatatable
        },
    }).mount('#app');
</script>
@endsection