<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdmin = Role::where('name', 'Admin')->first();
        $permisosAdmin = Permission::where('name', 'like', 'configuracion%')->get();
        if ($rolAdmin == null) {
            $nuevoRol = new Role;
            $nuevoRol->name = 'Admin';
            $nuevoRol->save();

            if ($permisosAdmin->count()) {
                $nuevoRol->syncPermissions($permisosAdmin);
            }
        } else {
            if ($permisosAdmin->count()) {
                $rolAdmin->syncPermissions($permisosAdmin);
            }
        }
        
        $rolEmpresa = Role::where('name', 'Empresa')->first();
        if ($rolEmpresa == null) {
            $nuevoRol = new Role;
            $nuevoRol->name = 'Empresa';
            $nuevoRol->save();
        }

        $rolCliente = Role::where('name', 'Cliente')->first();
        if ($rolCliente == null) {
            $nuevoRol = new Role;
            $nuevoRol->name = 'Cliente';
            $nuevoRol->save();
        }

    }
}
