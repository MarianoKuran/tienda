<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
    }
}
