@include('theme.dashboard.partialDashboard.head')

@auth
    @include('theme.dashboard.partialDashboard.topBar')
    @include('theme.dashboard.partialDashboard.dashSideBar')

@endauth



@yield('content')

@include('theme.partialThemes.scripts')
