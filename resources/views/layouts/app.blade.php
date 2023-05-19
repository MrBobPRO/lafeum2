<!DOCTYPE html>
<html lang="ru">

<head>
    @include('layouts.meta-tags')

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
            @yield('main')
            <x-scroll-buttons />
            @include('layouts.video-modal')
            @include('layouts.photo-modal')
            <x-spinner />
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
