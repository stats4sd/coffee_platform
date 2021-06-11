<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>State of the Coffee Smallholder Platform</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    .text-block {
    position: absolute;
    top: 400px;
    color: white;
    padding-bottom: 50px;
    font-weight: 700;
    text-align: left;
    /* font-size: 55px; */
    padding-left: 5%;
    padding-right: 5%;
    line-height: 1.2;
    width: 100%;
    font-family:  sans-serif;
    }
    #report_button{
        position: absolute;
        top: 400px;
    }

    .report-text{
        position: absolute;
        opacity: 1;
        font-weight: 500;
        text-align: left;
        /* font-size: 55px; */
        padding:100px;
        line-height: 1.2;
        font-family:  sans-serif;

    }
    
    .arrow {
    /* margin-bottom: 0.4em; */
    font-size:24px;
    /* width: 2.5rem;
    height: 2.5rem; */
    /* padding-top: 0.35em; */
    /* position:relative; */
    /* padding: 10px; */
    padding-top: 30px;
    /* padding-right: 30px; */
    padding-bottom: 30px;
    /* padding-left: 5px; */
    }

    #image_home_header{
    width:100%;  
    object-fit:cover; 
    height:500px;
    }

    #image_home_report{
    width:75%;  
    object-fit:cover; 
    height:500px;
    }

    #image_about{
    width:100%;
    object-fit:cover;
    height:500px;
    position: absolute;
    }

    #image_report{
    width:100%;
    position: absolute;
    object-fit:cover;
    height:500px;
    }


    </style>
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
                <div class="text-right">
                    <p class="m-0 text-white" > Admin panel powered by <a class="m-0 text-white" href="https://backpackforlaravel.com/">Backpack for Laravel</a></p>
                </div>
            </div>
            </div>
        </footer>
    </div>



    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @stack('scripts')

</body>
</html>
