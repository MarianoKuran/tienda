<div class="dropdown">
    <button class="dropbtn glass-box tag-traducible">{{$idiomaSeleccionadoDescripcion}}</button>
    <div class="dropdown-content">
        @foreach ($idiomas as $i)
            @if ($i->IdiomaID != $idiomaSeleccionadoID)
                <div class="tag-traducible" data-idioma-id="{{$i->IdiomaID}}" wire:click="setIdioma({{$i->IdiomaID}})">{{$i->Descripcion}}</div>
            @endif
        @endforeach
    </div>
</div>