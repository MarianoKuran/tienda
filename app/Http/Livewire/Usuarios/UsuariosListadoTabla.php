<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    //EDIT
    public $editando;
    public $usuario;
    public $mostrarContraseña;
    public $usuarioNombre;
    public $usuarioContraseña;
    public $usuarioCorreo;

    protected $listeners = [
        'usuarios-listado-tabla-eliminar'=>'eliminarUsuario',
    ];

    public function mount($withTabs = null, $tabs = null, $withSearchInput = null, $columns = null, $title = '')
    {
        $this->tabSeleccionada = 0;
        $this->withTabs = $withTabs;
        $this->withSearchInput = $withSearchInput;
        $this->tabs = $tabs;
        $this->columns = $columns;
        $this->title = $title;
        $this->editando = false;
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

    public function mostrarModalEdicion($u)
    {
        $this->editando = true;
        $this->mostrarContraseña = false;
        $this->usuario = User::find($u);
        $this->usuarioNombre = $this->usuario->name;
        $this->usuarioCorreo = $this->usuario->email;
    }

    public function ocultarModalEdicion()
    {
        $this->reset([
            'editando',
            'usuarioNombre',
            'usuarioCorreo',
            'usuarioContraseña',
        ]);
    }

    public function grabarCambios()
    {
        $this->usuario->name = $this->usuarioNombre;
        $this->usuario->email = $this->usuarioCorreo;
        $this->usuario->password = Hash::make($this->usuarioContraseña);
        $this->usuario->save();

        $this->dispatchBrowserEvent('alertaExito', [
            'titulo'=>'¡Actualizado Correctamente!',
            'mensaje'=>'',
        ]);

        $this->reset([
            'editando',
            'usuarioNombre',
            'usuarioCorreo',
            'usuarioContraseña',
        ]);
    }

    public function eliminarUsuario($usuarioID, $accionConfirmada = false)
    {
        $this->usuario = User::find($usuarioID);

        if ($accionConfirmada) {
            $this->usuario->delete();

            $this->dispatchBrowserEvent('alertaExito', [
                'titulo'=>'¡Eliminado Exitosamente!',
                'mensaje'=> null,
                'html'=> '<strong style="font-size:1.2em;">'.$this->usuario->name.'</strong> ha sido eliminado correctamente del registro de usuarios',
            ]);

            $this->reset([
                'editando',
                'usuarioNombre',
                'usuarioCorreo',
                'usuarioContraseña',
            ]);
        } else {
            $this->dispatchBrowserEvent('alertaConfirmarAccion', [
                'titulo' => '¿Seguro que desea eliminar a '. $this->usuario->name .' del registro de usuarios?',
                'mensaje' => 'Esta accion es irreversible',
                'accion' => 'usuarios-listado-tabla-eliminar',
                'atributo' => $this->usuario->id
            ]);
        }
    }
}
