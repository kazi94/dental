<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dental_Office_Management') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/vendors/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella/vendors/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('gentelella/vendors/animate.css/animate.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('gentelella/build/css/custom.css') }}" rel="stylesheet">    
</head>
  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              
              <h1>Se Connecter</h1>
              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror              
              <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Se connecter') }}
                    </button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="separator">
                <div>
                  <h1><i class="fa fa-medkit"></i> dental office management!</h1>
                  <p>©2019 touts droits réservés. </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
