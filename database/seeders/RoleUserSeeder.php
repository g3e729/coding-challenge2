<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::get()->pluck('id')->toArray();
        $users = User::get();

        foreach ($users as $user) {
            shuffle($roles);
            
            $randRoles = array_slice($roles, 0, rand(1, 4));
            $user->roles()->attach($randRoles);
        }


    }
}
