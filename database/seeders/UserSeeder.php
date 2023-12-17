<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        if ($user == null) {
            $newUser = new User;
            $newUser->name = "Mariano Kuran";
            $newUser->email = "marianokuran6@gmail.com";
            $newUser->google_id = "101582485567679856433";
            $newUser->save();

            $role = Role::where('name', 'Admin')->first();
            $newUser->assignRole($role);
        }

        //CLIENTES
        $role = Role::where('name', 'Cliente')->first();
        $password = Hash::make('12345678');
        $cantidad = 20;

        for ($i=0; $i < $cantidad; $i++) {
            $name = fake()->unique()->firstName();
            $user = User::where('name', $name)->first();
            
            if ($user == null) {
                $newUser = new User;
                $newUser->name = $name;
                $newUser->email = $newUser->name."@tienda.com";
                $newUser->password = $password;
                $newUser->save();
                
                $newUser->assignRole($role);
            }
        }

        //EMPRESAS
        $role = Role::where('name', 'Empresa')->first();
        $password = Hash::make('12345678');
        $cantidad = 20;

        for ($i=0; $i < $cantidad; $i++) {
            $name = fake()->unique()->firstName().' S.A';
            $user = User::where('name', $name)->first();

            if ($user == null) {
                $newUser = new User;
                $newUser->name = $name;
                $newUser->email = str_replace(' ', '_', $newUser->name)."@tienda.com";
                $newUser->password = $password;
                $newUser->save();
                
                $newUser->assignRole($role);
            }
        }
    }
}
