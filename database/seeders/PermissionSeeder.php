<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'code' => 'create',
                'description' => 'Create User',
                'menu_id' => 2
            ],
            [
                'id' => 2,
                'code' => 'read',
                'description' => 'Read User',
                'menu_id' => 2
            ],
            [
                'id' => 3,
                'code' => 'update',
                'description' => 'Update User',
                'menu_id' => 2
            ],
            [
                'id' => 4,
                'code' => 'delete',
                'description' => 'Delete User',
                'menu_id' => 2
            ],
            [
                'id' => 5,
                'code' => 'configure_role',
                'description' => 'Add and remove role of user',
                'menu_id' => 2
            ],
            [
                'id' => 6,
                'code' => 'create',
                'description' => 'Create Role',
                'menu_id' => 3
            ],
            [
                'id' => 7,
                'code' => 'read',
                'description' => 'Read Role',
                'menu_id' => 3
            ],
            [
                'id' => 8,
                'code' => 'update',
                'description' => 'Update Role',
                'menu_id' => 3
            ],
            [
                'id' => 9,
                'code' => 'delete',
                'description' => 'Delete Role',
                'menu_id' => 3
            ],
            [
                'id' => 10,
                'code' => 'configure_permission',
                'description' => 'Add and remove permission of role',
                'menu_id' => 3
            ],
            [
                'id' => 11,
                'code' => 'create',
                'description' => 'Create Menu',
                'menu_id' => 4
            ],
            [
                'id' => 12,
                'code' => 'read',
                'description' => 'Read Menu',
                'menu_id' => 4
            ],
            [
                'id' => 13,
                'code' => 'update',
                'description' => 'Update Menu',
                'menu_id' => 4
            ],
            [
                'id' => 14,
                'code' => 'delete',
                'description' => 'Delete Menu',
                'menu_id' => 4
            ],
            [
                'id' => 15,
                'code' => 'create',
                'description' => 'Create Permission',
                'menu_id' => 5
            ],
            [
                'id' => 16,
                'code' => 'read',
                'description' => 'Read Permission',
                'menu_id' => 5
            ],
            [
                'id' => 17,
                'code' => 'update',
                'description' => 'Update Permission',
                'menu_id' => 5
            ],
            [
                'id' => 18,
                'code' => 'delete',
                'description' => 'Delete Permission',
                'menu_id' => 5
            ],
            [
                'id' => 15,
                'code' => 'create',
                'description' => 'Create Employee',
                'menu_id' => 7
            ],
            [
                'id' => 16,
                'code' => 'read',
                'description' => 'Read Employee',
                'menu_id' => 7
            ],
            [
                'id' => 17,
                'code' => 'update',
                'description' => 'Update Employee',
                'menu_id' => 7
            ],
            [
                'id' => 18,
                'code' => 'delete',
                'description' => 'Delete Employee',
                'menu_id' =>7
            ],
            
        ]);
    }
}
