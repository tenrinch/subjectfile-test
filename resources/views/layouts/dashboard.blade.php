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
                    
                        <div class="absolute right-0 top-0 mx-2 mt-5 w-1/2 xl:w-1/5 lg:w-1/4 md:w-2/5 sm:w-1/2 z-50" >
                            @if(session()->has('success'))
                            <div class="bg-green-200 px-6 py-3  my-3 rounded-md flex items-center w-100" 
                                x-data="{ show: true }" 
                                x-show="show" 
                                x-init="setTimeout(() => show = false, 2500)"
                                x-transition:enter="transition ease-in duration-200"
                                x-transition:enter-start="transform opacity-0 translate-y-2"
                                x-transition:enter-end="transform opacity-100"
                                x-transition:leave="transition ease-out duration-500"
                                x-transition:leave-start="transform translate-x-0 opacity-100"
                                x-transition:leave-end="transform translate-x-full opacity-0">
                              <i class="text-sm fas fa-check text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                              </i>
                              <span class="text-green-800 text-xs"> {{ session('success') }} </span>
                            </div>
                            @endif

                            @if(session()->has('delete'))
                            <div class="bg-red-200 px-6 py-3  my-3 rounded-md flex items-center w-100" 
                                x-data="{ show: true }" 
                                x-show="show" 
                                x-init="setTimeout(() => show = false, 2500)"
                                x-transition:enter="transition ease-in duration-200"
                                x-transition:enter-start="transform opacity-0 translate-y-2"
                                x-transition:enter-end="transform opacity-100"
                                x-transition:leave="transition ease-out duration-500"
                                x-transition:leave-start="transform translate-x-0 opacity-100"
                                x-transition:leave-end="transform translate-x-full opacity-0">
                              <i class="text-sm fas fa-times text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                              </i>
                              <span class="text-red-800 text-xs"> {{ session('delete') }} </span>
                            </div>
                            @endif
                        </div>
                    
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
