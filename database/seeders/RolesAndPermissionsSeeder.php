<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

        ];

        $Userpermissions = [];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $role->syncPermissions($permissions);


        $User = Role::firstOrCreate(['name' => 'User']);
        $User->syncPermissions($Userpermissions);
    }
}
