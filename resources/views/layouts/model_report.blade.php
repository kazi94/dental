<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="screen"  />
        <link rel="stylesheet" type="text/css" media="print"  />
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('architect/main.css') }}" >

    </head>
    <body @if (strpos(url()->current(),"/appointement") != false) onload="init();" @endif>

        @yield('content') 

        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script type="text/javascript">
            $(window).on("load",function(){
                window.print();
            });
        </script>
    </body>
</html>
