<section class="menu-items-ctn">
    @foreach ($menu as $m)
        @php
            $nivel = substr_count($m['Permiso'], '.') + 1;
        @endphp
        @can($m['Permiso'])
            @if ($m['Url'] != '#' && $m['Url'] != null)
                <a  href="{{$m['Url']}}"
                    class="menu-item {{$m['PadreID'] != 0 ? 'invisible invisible-c' : ''}} {{ 'link-l'.$nivel}}"
                    title="{{$m['Descripcion']}}" 
                    data-menu-id={{ $m['MenuID'] }} 
                    data-padre-id={{ $m['PadreID'] != 0 ? $m['PadreID'] : 0 }}
                    data-nivel="{{ $nivel }}"
                    data-url="{{ $m['Url'] }}"
                    data-titulo="{{ $m['Titulo'] }}"
                    data-icon="{{ $m['Icon'] }}"
                >
                    {{$m['Titulo']}}
                </a>
            @else
                <div class="menu-item {{$m['PadreID'] != 0 ? 'invisible invisible-c' : ''}} {{ 'link-l'.$nivel}}" 
                    title="{{$m['Descripcion']}}" 
                    data-menu-id={{ $m['MenuID'] }} 
                    data-padre-id={{ $m['PadreID'] != 0 ? $m['PadreID'] : 0 }}
                    data-nivel="{{ $nivel }}"
                    data-url="{{ $m['Url'] }}"
                    data-titulo="{{ $m['Titulo'] }}"
                    data-icon="{{ $m['Icon'] }}"
                >
                    {{$m['PadreID'] == 0 ? $m['Titulo'] : ''}}
                </div>
            @endif
        @endcan
    @endforeach
</section>