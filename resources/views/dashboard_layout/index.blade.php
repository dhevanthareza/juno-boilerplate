@if(request()->header('X-Partial-Content') == true)
    @yield('content')
@else
    {!! View::make('dashboard_layout.head') !!}
    {!! View::make('dashboard_layout.sidebar') !!}
    {!! View::make('dashboard_layout.header') !!}

    @yield('content')

    {!! View::make('dashboard_layout.footer') !!}
    {!! View::make('dashboard_layout.foot') !!}
@endif