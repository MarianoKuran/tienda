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
                        <a href="#" class="inline-flex items-center p-2 text-sm text-purple-600 bg-white rounded-lg shadow-lg"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="inline-flex items-center p-2 text-sm text-red-700 bg-white rounded-lg shadow-lg"> <i class="fa fa-trash"></i></a>
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
</div>
