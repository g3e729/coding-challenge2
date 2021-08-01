<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'can:view',
            'can:create',
            'can:edit',
            'can:delete',
        ];

        foreach ($roles as $name) {
            Role::create(compact('name'));
        }
    }
}
