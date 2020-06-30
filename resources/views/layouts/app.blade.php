<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head') 
<<<<<<< HEAD
    <body @if (strpos(url()->current(),"/appointement") != false) onload="init();" @endif >
        
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar" >
=======
    <body @if (strpos(url()->current(),"/appointement") != false) onload="init();" @endif>
        
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
            @include('layouts.header')   
            <div class="app-main">

                @include('layouts.aside')

                <div class="app-main__outer">

                    @yield('content') 

                    @include('layouts.footer')
                    
                </div>                
            </div>
        </div>

        {{-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> --}}
<<<<<<< HEAD
        {{-- <script type="text/javascript" src="{{ asset('architect/assets/scripts/main.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        @yield('js_scripts')
=======
        <script type="text/javascript" src="{{ asset('architect/assets/scripts/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        <script>
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>
