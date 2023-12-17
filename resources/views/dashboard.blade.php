<x-app-layout>
    <div name="slot" class="flex items-center justify-center w-[100%] h-[100%] text-[2em] font-bold">
        ¡Bienvenido, <p class="text-purple-500 ml-2">{{ Auth::user()->name }}</p>! 
    </div>
</x-app-layout>
