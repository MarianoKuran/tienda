<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosListadoTabla extends Component
{
    use WithPagination;

    //TABS
    public $tabSeleccionada;
    public $withTabs;
    public $tabs;

    //SEARCH
    public $withSearchInput;
    public $busqueda;

    //TABLES
    public $columns;
    public $title;

    public function mount($withTabs = null, $tabs = null, $withSearchInput = null, $columns = null, $title = '')
    {
        $this->tabSeleccionada = 0;
        $this->withTabs = $withTabs;
        $this->withSearchInput = $withSearchInput;
        $this->tabs = $tabs;
        $this->columns = $columns;
        $this->title = $title;
    }

    public function render()
    {
        $usuarios = User::query();
        $rolNombre =  $this->tabs[$this->tabSeleccionada] == 'Clientes' ? 'Cliente':'Empresa';

        $usuarios = $usuarios->whereHas('roles', function($q) use($rolNombre){
            $q = $q->where('name', $rolNombre);
        });

        if ($this->busqueda != null) {
            $usuarios = $usuarios->where('name', 'like', '%'.$this->busqueda.'%')->where('email', 'like', '%'.$this->busqueda.'%');
        }

        $usuarios = $usuarios->orderBy('name', 'asc')->paginate(10);

        return view('livewire.usuarios.usuarios-listado-tabla', [
            'usuarios' => $usuarios->appends([
                'withTabs' => $this->withTabs,
                'tabSeleccionada' => $this->tabSeleccionada,
                'withSearchInput' => $this->withSearchInput,
                'tabs' => $this->tabs,
                'busqueda' => $this->busqueda,
            ]),
        ]);
    }

    public function setearTabSeleccionada($tabID)
    {
        $this->tabSeleccionada = $tabID;
    }
}
