{!! View::make('layout.head') !!}
{{-- Tools --}}
<script src="{!! asset('js/toast.js') !!}"></script>
<script src="{!! asset('js/loading.js') !!}"></script>
<script src="{!! asset('js/httpClient.js') !!}"></script>
<script>
    initializeHttpClient("{!! csrf_token() !!}");
</script>
@yield('content')

{!! View::make('layout.foot') !!}
