<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head') 
    <body @if (strpos(url()->current(),"/rendez-vous") != false) onload="init();" @endif >
        
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar" >
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
        {{-- <script type="text/javascript" src="{{ asset('architect/assets/scripts/main.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        @yield('js_scripts')
        <script>
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>
