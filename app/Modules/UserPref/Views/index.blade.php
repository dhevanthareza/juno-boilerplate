@extends('dashboard_layout.index')
@section('content')
    <div class="page-inner" id="user-pref">
        <default-datatable title="UserPref" url="{!! url('user-pref') !!}" :headers="headers" />
    </div>

    <script>
        createApp({
            data() {
                return {
                    headers: [{
                            text: 'Id',
                            value: 'id',
                        },
                        {

                            value: 'tes_string',
                            text: 'Tes String'

                        },
                        {

                            value: 'tes_double',
                            text: 'Tes Double'

                        },
                        {

                            value: 'tes_decimal',
                            text: 'Tes Decimal'

                        },
                        {
                            value: 'tes_text',
                            text: 'Tes Text'
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
