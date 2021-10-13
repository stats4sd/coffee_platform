<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <?php $googleAnalyticsId = env("GOOGLE_ANALYTICS_ID", ""); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalyticsId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ $googleAnalyticsId }}');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>State of the Smallholder Coffee Farmer</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('styles')

</head>
<body>
     <div class="full-height d-flex flex-column bg-white">

        <div class="header-wrapper h-2">
        @include('layouts.header')
        </div>

        <div class="flex-grow-1">
            @yield('main')
        </div>

        <!-- Footer -->
        <footer class="py-3 mt-auto bg-dark footer">
            <div class="container d-flex flex-justify-between">
            <div class="col-sm-3">
                <p class="m-0 text-white" >Developed by <a class="m-0 text-white" href="https://stats4sd.org/">Stats4SD</a><br></p>
            </div>
            <div class="container d-flex justify-content-end flex-column align-items-end">
                <a class="m-0 text-white" href="{{ route('backpack') }}">Admin Login</a>
            </div>
            </div>
        </footer>
    </div>



    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @stack('scripts')

</body>
</html>
