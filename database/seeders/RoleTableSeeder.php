<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();

        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => json_encode([
                'create-page' => true,
                'view-page' => true,
                'delete-page' => true,
                'update-page' => true
            ]),
        ]);

        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'permissions' => json_encode([
                'create-page' => true,
                'update-page' => true
            ]),
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => json_encode([
                'view-page' => true
            ]),
        ]);
    }
}
