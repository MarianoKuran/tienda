<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso = Permission::where('name', 'configuracion')->first();
        if ($permiso == null) {
            Permission::create(['name'=>'configuracion']);
        }


        $permiso = Permission::where('name', 'configuracion.usuarios')->first();
        if ($permiso == null) {
            Permission::create(['name'=>'configuracion.usuarios']);
        }
    }
}
