<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Laravel') }}</title> 
        <link rel="icon" href="/assets/images/">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:url" content="" /><!-- double check this one -->
        <meta property="og:description" content="" /><!-- add content -->
        <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/assets/css/ie8.css"><![endif]-->
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    </head>
    <body>
        <div class="bodyWrap flex">
            
            @yield('body')


            <footer>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="assets/js/script.js"></script>
            </footer>
        </div><!-- /.bodyWrap -->
    </body>
</html>