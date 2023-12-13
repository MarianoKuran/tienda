<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menu = Menu::where('Titulo', 'Configuracion')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Configuracion';
            $menuNuevo->Descripcion = 'Listado de opciones de configuracion del sistema';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion';
            $menuNuevo->PadreID = 0;
            $menuNuevo->Hijos = 1;
            $menuNuevo->Icon = null;
            $menuNuevo->save();
        }
        $menu = Menu::where('Titulo', 'Usuarios')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Usuarios';
            $menuNuevo->Descripcion = 'Listado de opciones de configuracion del sistema';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion.usuarios';
            $menuNuevo->PadreID = 1;
            $menuNuevo->Hijos = 1;
            $menuNuevo->Icon = null;
            $menuNuevo->save();
        }
        $menu = Menu::where('Titulo', 'Roles')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Roles';
            $menuNuevo->Descripcion = 'Opciones de config de roles del sistema';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion.roles';
            $menuNuevo->PadreID = 1;
            $menuNuevo->Hijos = 1;
            $menuNuevo->Icon = null;
            $menuNuevo->save();
        }
        $menu = Menu::where('Titulo', 'Listado de roles')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Listado de roles';
            $menuNuevo->Descripcion = 'Listado con todos los roles del sistema existentes';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion.roles.listado';
            $menuNuevo->PadreID = 3;
            $menuNuevo->Hijos = 0;
            $menuNuevo->Icon = 'fa fa-address-card';
            $menuNuevo->save();
        }
        $menu = Menu::where('Titulo', 'Listado de usuarios')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Listado de usuarios';
            $menuNuevo->Descripcion = 'Listado con todos los usuarios del sistema existentes';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion.usuarios.listado';
            $menuNuevo->PadreID = 2;
            $menuNuevo->Hijos = 0;
            $menuNuevo->Icon = 'fa fa-users';
            $menuNuevo->save();
        }
        $menu = Menu::where('Titulo', 'Editar Roles')->first();
        if ($menu == null) {
            $menuNuevo = new Menu;
            $menuNuevo->Titulo = 'Editar Roles';
            $menuNuevo->Descripcion = 'Opciones de configuracion de roles';
            $menuNuevo->Url = '#';
            $menuNuevo->Permiso = 'configuracion.roles.modificacion';
            $menuNuevo->PadreID = 3;
            $menuNuevo->Hijos = 0;
            $menuNuevo->Icon = 'fas fa-users-cog';
            $menuNuevo->save();
        }
    }
}
