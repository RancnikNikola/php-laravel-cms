<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        Permission::create([
            'name' => 'create-page'
        ]);
        Permission::create([
            'name' => 'view-page'
        ]);
        Permission::create([
            'name' => 'delete-page'
        ]);
        Permission::create([
            'name' => 'update-page'
        ]);
    }
}
