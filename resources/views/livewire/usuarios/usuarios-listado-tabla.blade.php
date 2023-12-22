<div class="flex flex-col items-center w-full md:py-4 rounded">
    <ul class="flex flex-wrap md:w-[75%] text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50" id="tab-nav" role="tablist">
        <li class="inline-block p-4 w-[100%] md:w-[fit-content] rounded-ss-lg text-purple-700 bg-purple-100">
            {{$title}}
        </li>
        @if ($withTabs && $tabs && count($tabs))
            @foreach ($tabs as $i => $tab)
                <li class="w-[{{100 / count($tabs) }}%] md:w-[fit-content]" wire:click="setearTabSeleccionada({{$i}})">
                    <button type="button" class="w-full inline-block p-4 rounded-ss-lg text-purple-400 @if($tabSeleccionada == $i) text-purple-700 border-b-2 border-purple-400 @else hover:border-b-2 hover:border-purple-400 @endif" role="tab">{{$tab}}</button>
                </li>
            @endforeach
        @endif
        @if ($withSearchInput)
            <div class="flex w-[100%] md:max-w-[300px] m-2 md:m-0 md:p-2">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative w-[100%] md:max-w-[300px]">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" class="block w-[100%] ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500" placeholder="Buscar" wire:model.debounce.200ms="busqueda">
                </div>
            </div>
        @endif
    </ul>

    {{-- WEB --}}
    <div class="hidden md:flex flex-col justify-center w-[75%] py-4">
        <table class="text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-purple-700 uppercase bg-purple-50">
                <tr class="text-center">
                    @if (count($columns))
                        @foreach ($columns as $c)
                            <th scope="col" class="px-6 py-3">
                                {{$c}}
                            </th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($usuarios)
                    @foreach ($usuarios as $u)
                        @if ($u->getRoleNames()[0].'s' == $tabs[$tabSeleccionada])
                            <tr class="border-b odd:bg-white even:bg-gray-50 text-center hover:bg-purple-100">
                                <td class="px-6 py-4">
                                    {{$u->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$u->email}}
                                </td>
                                <td class="px-6 py-4 flex justify-center">
                                    @if ($u->profile_photo != null)
                                        <img src="{{asset($u->profile_photo)}}" class="h-8" alt="avatar-usuario" >
                                    @else
                                        <img src="{{asset('/images/single-image-placeholder.png')}}" class="h-8" alt="avatar-usuario">
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="mostrarModalEdicion({{$u->id}})" class="inline-flex items-center p-3 text-sm text-white bg-purple-400 rounded-lg shadow-lg hover:bg-purple-800 duration-300"><i class="fa fa-pencil"></i></button>
                                    <button class="inline-flex items-center p-3 text-sm bg-red-700 text-white rounded-lg shadow-lg hover:bg-red-800 hover:text-white duration-300"> <i class="fa fa-trash"></i></button> 
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr class="text-center ">
                        <td colspan="100" class="bg-white font-bold p-2 ">
                            <span class="bg-purple-200 px-3 py-1 rounded"> No se encontraron resultados </span>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-2">
            @if ($usuarios)
                {{ $usuarios->links() }}
            @endif
        </div>
    </div>

    {{-- MOBILE --}}
    <div class="md:hidden w-full flex flex-wrap justify-center">
        <div class="flex justify-center mt-2 w-[100%]">
            <div class="w-[200px]">
                @if ($usuarios)
                    {{ $usuarios->links() }}
                @endif
            </div>
        </div>
        @foreach ($usuarios as $u)
            <div class="w-[90%] my-1 max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <div class="flex items-center justify-start">
                    @if ($u->profile_photo != null)
                        <img class="w-10 h-10 m-2 rounded-full shadow-lg" src="{{asset($u->profile_photo)}}" alt="{{$u->name}} profile photo"/>
                    @else
                        <img class="w-10 h-10 m-2 rounded-full shadow-lg" src="{{asset('/images/single-image-placeholder.png')}}" alt="{{$u->name}} profile photo"/>
                    @endif
                    <div class="flex flex-col">
                        <h5 class="text-sm font-bold text-purple-900">{{$u->name}}</h5>
                        <span class="text-xs text-gray-500">{{$u->email}}</span>
                    </div>
                    <div class="flex justify-end w-[100%] ml-2 pr-2 gap-2">
                        <button href="#" wire:click="mostrarModalEdicion({{$u->id}})" class="inline-flex items-center p-2 text-sm text-purple-600 bg-white rounded-lg shadow-lg"><i class="fa fa-pencil"></i></button>
                        <button href="#" wire:click="eliminarUsuario({{$u->id}})" class="inline-flex items-center p-2 text-sm text-red-700 bg-white rounded-lg shadow-lg"> <i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="flex justify-center my-2 w-[100%]">
            <div class="w-[200px]">
                @if ($usuarios)
                    {{ $usuarios->links() }}
                @endif
            </div>
        </div>
    </div>

    {{-- backdrop modal --}}
    @if ($editando)
        <div class="absolute flex justify-center items-center z-10 bg-gray-600 max-h-[901px] h-[870px] w-full md:w-[90%] opacity-60"></div>
        <div class="absolute top-[25%] z-20 bg-white h-[fit-content] w-[90%] md:w-[50%] rounded shadow-md">
            <ul class="flex items-center w-[100%] text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50" id="tab-nav" role="tablist">
                <div class="flex flex-wrap max-w-[95%]">
                    <li class="inline-block p-4 w-[100%] md:w-[fit-content] rounded-ss-lg text-purple-700 bg-purple-100">
                        Editar Usuario
                    </li>
                </div>

                <div class="flex justify-end flex-1 pr-2">
                    <button wire:click="ocultarModalEdicion" class="fa fa-times h-8 shadow-md py-1 px-2 rounded-md text-purple-600 hover:bg-purple-200"></button>
                </div>
            </ul>
            <div class="m-4">
                <label for="nombre" id="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                <input type="text" class="form-control bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-purple-500 block w-full p-2.5" wire:model="usuarioNombre">
                <label for="correo" class="block mb-2 text-sm font-medium text-gray-900">Correo</label>
                <input type="text" id="correo" class="form-control bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-purple-500 block w-full p-2.5" wire:model="usuarioCorreo">
                <label for="contraseña" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                <div class="relative">
                    <input type="{{ $mostrarContraseña ? 'text' : 'password'}}" id="contraseña" class="form-control bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-purple-500 block w-full p-2.5" wire:model="usuarioContraseña">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
                        @if (!$mostrarContraseña)
                            <svg class="h-6 text-gray-700" fill="none" wire:click="$set('mostrarContraseña', true)"
                                class="block" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 576 512">
                                <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                </path>
                            </svg>
                        @else
                            <svg class="h-6 text-gray-700" fill="none" wire:click="$set('mostrarContraseña', false)"
                                class="block" xmlns="http://www.w3.org/2000/svg"
                                viewbox="0 0 640 512">
                                <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                </path>
                            </svg>
                        @endif
                    </div>
                  </div>
            </div>
            <ul class="flex justify-end items-center w-[100%] pr-2 text-sm font-medium text-center text-gray-500 rounded bg-gray-50">
                <button wire:click="grabarCambios" class="h-10 w-20 shadow-md m-2 py-1 px-2 rounded-md text-white bg-purple-500 hover:bg-purple-800 hover:text-white">Confirmar</button>
                <button wire:click="ocultarModalEdicion" class="h-10 w-20 shadow-md m-2 py-1 px-2 rounded-md text-purple-400 bg-white hover:bg-purple-100 hover:text-purple-600">Cancel</button>
            </ul>
        </div>
    @endif
</div>
