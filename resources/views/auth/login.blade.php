<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots" content="noindex">

        @include('layouts.styles')

    </head>
    <body class="layout-login">
        <div class="layout-login__overlay"></div>
        <div class="layout-login__form bg-white" data-perfect-scrollbar>
            <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
                <a href="" class="navbar-brand" style="min-width: 0">
                    <img class="navbar-brand-icon" src="{{asset('assets/logo.png')}}" width="250" alt="NTA">
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-4">
                    <div class="text-danger">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <h4 class="m-0">Welcome back!</h4>
                <p class="mb-5">Login to access your Account </p>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="text-label" for="email_2">{{__('Email Address:')}}</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2" 
                            type="email" 
                            required="" 
                            class="form-control form-control-prepended" 
                            placeholder="example@eamil.com" 
                            value="{{old('email')}}" 
                            name="email"
                        autofocus>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="password_2">{{__('Password:')}}</label>
                    <div class="input-group input-group-merge">
                        <input id="password_2" 
                        type="password"
                        name="password"
                        required="" 
                        class="form-control form-control-prepended" 
                        placeholder="Enter your password" 
                        required 
                        autocomplete="current-password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked="" id="remember">
                        <label class="custom-control-label" for="remember">Remember me</label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary mb-5" type="submit">{{ __('Login') }}</button><br>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>
            </form>
        </div>

        @include('layouts.scripts')
    </body>
</html>
