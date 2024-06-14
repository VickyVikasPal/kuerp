<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Asha ERP</title>
        <!-- <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        
        <link href="{{url('assets/css/style.css')}}" rel="stylesheet"> -->
        <link href="{{url('public/assets/css/style.css')}}" rel="stylesheet"> 
        <link href="{{url('public/assets/css/fonts.css')}}" rel="stylesheet">
     
    </head>
    <body>
    <div id="app"></div>
     @vite('resources/js/app.js')

    <!-- <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/fonts.js') }}"></script> -->

    </body>
</html>

