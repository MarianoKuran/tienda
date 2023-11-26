<?php

namespace App\Http\Livewire\Idioma;

use App\Models\Idioma;
use Livewire\Component;

class SelectIdioma extends Component
{
    public $idiomaSeleccionado;
    public $idiomaSeleccionadoID;
    public $idiomaSeleccionadoDescripcion;

    //select
    public $idiomas;

    public function mount()
    {
        $this->idiomaSeleccionado = Idioma::where('Seleccionado', 1)->first();
        $this->idiomaSeleccionadoDescripcion = $this->idiomaSeleccionado->Descripcion;
        $this->idiomaSeleccionadoID = $this->idiomaSeleccionado->IdiomaID;
        $this->idiomas = Idioma::all();
    }


    public function setIdioma($idiomaID)
    {
        $nuevoIdiomaSeleccionado = Idioma::find($idiomaID);
        $nuevoIdiomaSeleccionado->Seleccionado = 1;
        $nuevoIdiomaSeleccionado->save();

        $this->idiomaSeleccionado->Seleccionado = 0;
        $this->idiomaSeleccionado->save();

        $this->idiomaSeleccionadoDescripcion = $nuevoIdiomaSeleccionado->Descripcion;
        $this->idiomaSeleccionadoID = $nuevoIdiomaSeleccionado->IdiomaID;

        $this->dispatchBrowserEvent('traducir', [
            'codigo'=>$nuevoIdiomaSeleccionado->Codigo
        ]);
    }

    public function render()
    {
        return view('livewire.idioma.select-idioma');
    }
}
