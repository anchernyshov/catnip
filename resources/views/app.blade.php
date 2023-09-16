<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @livewireStyles
</head>
<body>
    @if (Auth::check())
        @include('header')
    @endif
    @yield('content')
    @livewireScripts
</body>
</html>