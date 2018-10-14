<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token (security reasons)-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Movie') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('inc/navbar')
        <div class='container'>
            @include('inc/messages')
            <br>
            <!-- 
            |-------------------------------------------
            |Installeer extentie voor VSCode
            |ext install laravel-blade
            |
            |De "Pages" krijgen allemaal deze lay-out.
            |--------------------------------------------
            -->
            @yield('content')
        </div>
        
        <!--
        Zodat ik in me create.blade.app de article-ckeditor kan gebruiken in me forms: 
        
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script> 
        -->
    </div>
</body>
</html>
