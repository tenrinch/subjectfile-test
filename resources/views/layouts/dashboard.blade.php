<!DOCTYPE html>

<html lang="en">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard</title>
        <meta name="theme-color" content="#ffffff">
        <!-- Icons-->
        <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
        <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
        <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
        <!-- Main styles for this application-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
         <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('css')

        <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="c-app">
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

            @include('components.sidebar')
            @include('components.header')

            <div class="c-body">

                <main class="c-main">

                    @yield('content') 

                </main>
                @include('components.footer2')
            </div>
        </div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>
        <!-- CoreUI and necessary plugins-->
        <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
        <script src="{{ asset('js/coreui-utils.js') }}"></script>
        <script src="{{ asset('js/alpine.min.js') }}" defer></script>
        @livewireScripts
        @yield('scripts')
        @stack('scripts')
        <script>
            function closeAlert(event){
                let element = event.target;
                while(element.nodeName !== "BUTTON"){
                    element = element.parentNode;
                }
                element.parentNode.parentNode.removeChild(element.parentNode);
            }
        </script>
    </body>
</html>
