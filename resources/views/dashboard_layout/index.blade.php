@if($just_content == 'true')
    @yield('content')
@else
    {!! View::make('dashboard_layout.header_js') !!}
    {!! View::make('dashboard_layout.sidebar') !!}
    {!! View::make('dashboard_layout.header') !!}

    @yield('content')

    {!! View::make('dashboard_layout.footer') !!}
    {!! View::make('dashboard_layout.footer_js') !!}
@endif