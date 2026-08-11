<!doctype html>
<html lang="en">

@include('theme.partialThemes.head')

<body>
    @include('theme.partialThemes.header')
    {{-- @include('theme.partialThemes.hero') --}}
    @yield('content')


    @include('theme.partialThemes.footer')

    @include('theme.partialThemes.scripts')

</body>

</html>
