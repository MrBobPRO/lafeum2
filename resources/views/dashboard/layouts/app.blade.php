<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Админка — {{ env('APP_NAME') }}</title>

    {{-- Noindex --}}
    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none">

    {{-- Selectize --}}
    <link rel="stylesheet" href="{{ asset('plugins/selectize/selectize.css') }}">

    {{-- Simditor v2.3.28 --}}
    <link rel="stylesheet" href="{{ asset('plugins/simditor/simditor.css') }}">

    {{-- Normalize CSS --}}
    <link rel="stylesheet" href="{{ asset('plugins/normalize.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dashboard/styles.css') }}">
</head>

<body class="body">
    @include('dashboard.layouts.header')
    @include('dashboard.layouts.aside')

    <main class="main">
        {{-- @include('dashboard.layouts.spinner')
    @include('dashboard.layouts.errors') --}}
        @yield('main')
    </main>

    {{-- JQuery --}}
    <script src="{{ asset('plugins/jquery/jquery-3.6.4.min.js') }}"></script>

    {{-- Selectize --}}
    <script src="{{ asset('plugins/selectize/selectize.min.js') }}"></script>

    {{-- Simditor v2.3.28 --}}
    <script src="{{ asset('plugins/simditor/module.js') }}"></script>
    <script src="{{ asset('plugins/simditor/hotkeys.js') }}"></script>
    <script src="{{ asset('plugins/simditor/uploader.js') }}"></script>
    <script src="{{ asset('plugins/simditor/simditor.js') }}"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
