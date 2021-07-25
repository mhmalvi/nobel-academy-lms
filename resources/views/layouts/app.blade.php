<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Learnque - @yield('title')</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    @include('layouts.styles')
</head>

<body class="layout-default">
    <div class="preloader"></div>
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout" id="app">
        <!-- Header -->
        @include('layouts.header')
        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">
            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">
                    {{-- <div class="py-4"></div> --}}
                    @yield('content')
                </div>
                <!-- // END drawer-layout__content -->

                @include('layouts.navigation')
            </div>
            <!-- // END drawer-layout -->
        </div>
        <!-- // END header-layout__content -->
    </div>
    <!-- // END header-layout -->

    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.scripts')
</body>

</html>
