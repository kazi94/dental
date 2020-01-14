<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')    
    <body class="nav-md" @if (strpos(url()->current(),"/appointement") != false) onload="init();" @endif>

        <div class="container body">
            
          <div class="main_container">
            @include('layouts.aside')
            
            @include('layouts.header')
            
            <div class="right_col" role="main" style="min-height:500px ">
                @yield('content')
            </div>
            
            @include('layouts.footer')

          </div>
        </div>

        @include('layouts.js_scripts')

    </body>
</html>
