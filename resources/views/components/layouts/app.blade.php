<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Catnip</title>
    </head>
    <body>
        @if (Auth::check())
            @if ( !request()->is('/') )
                <a href='/'>Dashboard</a>
            @endif
            <span>Hello, {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</span>
            <a href='/logout'>Log out</a>
        @endif
        {{ $slot }}
    </body>
</html>
