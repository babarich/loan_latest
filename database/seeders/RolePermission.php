<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'loan_approve',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'loan_return',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'loan_reject',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'loan_payment',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'loan_disbursement',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'loan_chart',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'loan_edit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'loan_delete',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        permission::insert($data);


        $roles = [
            'approver',
            'disbursement',
            'admin',
            'staff'
        ];

        $permissionDisburs = [1,2,3,4,5];
        $permissionRequest = [1,2,3];

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName == 'approver') {
                $role->givePermissionTo($permissionRequest);
            }elseif ($roleName == 'disbursement') {
                $role->givePermissionTo($permissionDisburs);
            }elseif ($roleName == 'admin') {
                $role->syncPermissions(Permission::all());
            }
        }
    }
}
