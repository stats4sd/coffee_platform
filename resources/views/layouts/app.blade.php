<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
        <footer class="py-3 mt-auto bg-dark footer h-1">
            <div class="container d-flex flex-justify-between">
                <p class="m-0 text-white">Developed By Stats4SD</p>
            </div>
            <!-- /.container -->
        </footer>
    </div>



    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @stack('scripts')

</body>
</html>
