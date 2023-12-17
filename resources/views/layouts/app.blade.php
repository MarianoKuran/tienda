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
                @include('components.side-menu')
                
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
