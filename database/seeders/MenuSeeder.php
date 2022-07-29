<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert(
            [
                'id' => 1,
                'name' => 'Setting',
                'description' => 'Organize Setting'
            ],
        );
        DB::table('menus')->insert([
            [
                'id' => 2,
                'name' => 'User',
                'path' => '/user',
                'description' => 'Organize User',
                'parent_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Role',
                'path' => '/role',
                'description' => 'Organize Role',
                'parent_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'Menu',
                'path' => '/menu',
                'description' => 'Organize Menu',
                'parent_id' => 1
            ],
            [
                'id' => 5,
                'name' => 'Permission',
                'path' => '/permission',
                'description' => 'Organize Permission',
                'parent_id' => 1
            ]
        ]);
    }
}
