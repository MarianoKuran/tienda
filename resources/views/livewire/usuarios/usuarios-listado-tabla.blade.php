<div class="flex flex-col items-center w-full py-4 rounded">
    <ul class="flex flex-wrap w-[75%] text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50" id="tab-nav" role="tablist">
        <li class="inline-block p-4 rounded-ss-lg text-purple-700 bg-purple-100">
            {{$title}}
        </li>
        @if ($withTabs && $tabs && count($tabs))
            @foreach ($tabs as $i => $tab)
                <li class="me-2" wire:click="setearTabSeleccionada({{$i}})">
                    <button type="button" class="inline-block p-4 rounded-ss-lg text-purple-400 @if($tabSeleccionada == $i) text-purple-700 border-b-2 border-purple-400 @else hover:border-b-2 hover:border-purple-400 @endif" role="tab">{{$tab}}</button>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="flex flex-col justify-center w-[75%] py-4">
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
</div>
