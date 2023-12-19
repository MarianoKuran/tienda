<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome 4 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- side-menu -->
        <link rel="stylesheet" href="{{asset('/styles/menu/index.css')}}">
        <link rel="stylesheet" href="{{asset('/styles/index.css')}}">
        <!-- side-menu -->
        <style>
            .nav{
                height: 65px;
                background-color: white;
            }
        </style>

        @if (isset($styles))
            {{ $styles }}
        @endif
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{asset('/js/side-menu.js')}}"></script>
        <!-- Font Awesome 5-->
        <script src="https://kit.fontawesome.com/d821ae6b42.js" crossorigin="anonymous"></script>

        {{-- obtenemos el tamaño de pantalla --}}
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                var mediaQ = screen.width;
                var sideMenuCtn = document.getElementById('side-menu-ctn');
                var sideMenu = document.getElementById('menu-items-ctn');

                window.addEventListener('resize', function(event) {
                    mediaQ = screen.width;
                    if (mediaQ >= 100 && mediaQ <= 425) {
                        sideMenu.classList = 'menu-items-ctn-mobile';
                        sideMenuCtn.classList = 'hidden';
                    } else {
                        sideMenuCtn.classList = '';
                        sideMenu.classList = 'menu-items-ctn';
                    }
                });
                
                if (mediaQ >= 100 && mediaQ <= 425) {
                    sideMenuCtn.classList = 'hidden';
                    sideMenu.classList = 'menu-items-ctn-mobile';
                } else {
                    sideMenuCtn.classList = '';
                    sideMenu.classList = 'menu-items-ctn';
                }
            })
        </script>
        {{-- obtenemos el menu --}}
        @php
            $menu = App\Models\Menu::query();
            $menu = $menu->orderBy('Permiso')->get();   
        @endphp
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="flex">
                <!-- side menu -->
                <div id="side-menu-ctn">
                    @include('components.side-menu')
                </div>
                
                <!-- Page Content -->
                @if (isset($slot))
                    <main class="w-[100%]">
                        {{ $slot }}
                    </main>
                @endif
            </div>
        </div>

        @if (isset($scripts))
            {{ $scripts }}
        @endif
    </body>
</html>
