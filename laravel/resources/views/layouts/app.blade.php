<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'Alara')}}</title>

    </head>
    <body>
        
        @include('inc/navbar')
        
        <div class= "container">
            <br>
            @include('inc/messages')
            <!-- 
            Installeer extentie voor VSCode
            ext install laravel-blade
            
            De "Pages" krijgen allemaal deze lay-out.
            -->
            @yield('content')
        </div>

        <!--Zodat ik in me create.blade.app de article-ckeditor kan gebruiken in me form -->
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
         </script>
    </body>
</html>
