<?php

namespace App\Http\Livewire\Idioma;

use Livewire\Component;

class SelectIdioma extends Component
{
    public $idiomaSeleccionado;

    public function mount($idiomaSeleccionado)
    {
        dd($idiomaSeleccionado);
        $this->idiomaSeleccionado = $idiomaSeleccionado;
    }

    public function render()
    {
        return view('livewire.idioma.select-idioma');
    }
}
