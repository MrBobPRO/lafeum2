<!DOCTYPE html>
<html lang="ru">

<head>
    <title>@hasSection('title')@yield('title'){{ ' — ЛАФЕЮМ' }}@else{{ 'ЛАФЕЮМ' }}@endif</title>

    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Normalize CSS --}}
    <link rel="stylesheet" href="{{ asset('plugins/normalize.css') }}">

    {{-- App Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app/media.css') }}">

    {{-- Google Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="{{ $pageClass }}">
    @include('layouts.header')

    <div class="main-wrapper">
        @yield('leftbar')

        <main class="main">
            @yield('main')
            <x-scroll-buttons />
            @include('layouts.video-modal')
            @include('layouts.photo-modal')
        </main>
    </div>

    @include('layouts.footer')

    {{-- App Scripts --}}
    <script src="{{ asset('plugins/jquery/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
