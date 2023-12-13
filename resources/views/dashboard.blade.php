<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{asset('/styles/menu/index.css')}}">
        <link rel="stylesheet" href="{{asset('/styles/index.css')}}">
    </x-slot>
    
    <x-slot name="menu">
        <x-side-menu :menu="$menu" />
    </x-slot>

    <x-slot name="scripts">
        <script src="{{asset('/js/side-menu.js')}}"></script>
        <!-- Font Awesome 5-->
        <script src="https://kit.fontawesome.com/d821ae6b42.js" crossorigin="anonymous"></script>
    </x-slot>
</x-app-layout>
