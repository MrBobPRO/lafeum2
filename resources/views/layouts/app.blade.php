<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.meta-tags')

    {{-- Google Material Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- Normalize CSS --}}
    <link rel="stylesheet" href="{{ asset('plugins/normalize.css') }}">

    {{-- App Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app/media.css') }}">
</head>

<body class="{{ $pageClass }}">
    @include('layouts.header')

    <div class="main-wrapper">
        @hasSection ('leftbar')
            @yield('leftbar')
        @endif

        <main class="main">
            @include('layouts.video-modal')
            @include('layouts.photo-modal')
            @yield('main')
            <x-scroll-buttons />
        </main>

        @includeWhen($includeRightBar, 'layouts.rightbar')
    </div>

    @include('layouts.footer')

    {{-- Yandex Share Buttons --}}
    <script src="https://yastatic.net/share2/share.js"></script>

    {{-- App Scripts --}}
    <script src="{{ asset('plugins/jquery/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
