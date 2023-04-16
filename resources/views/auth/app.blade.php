<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@hasSection('title')@yield('title'){{ ' — ЛАФЕЮМ' }}@else{{ 'ЛАФЕЮМ' }}@endif</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none" />

    {{-- Google Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>

    {{-- Normalize CSS --}}
    <link rel="stylesheet" href="{{ asset('plugins/normalize.css') }}">

    {{-- App Styles --}}
    <link rel="stylesheet" href="{{ asset('css/auth/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/media.css') }}">
</head>

<body class="body">
    <div class="box">
        @yield('form')
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>
