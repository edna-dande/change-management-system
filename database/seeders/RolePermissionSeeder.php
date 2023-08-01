<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolePermissions =[
            [
                'role_id'=>1,
                'permissions'=>[
                    '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'
                ]
            ],
            [
                'role_id'=>2,
                'permissions'=>[
                    '16','17','18','19','20','21','22','23','24','25'
                ]
            ],
            [
                'role_id'=>3,
                'permissions'=>[
                    '16','17','18','19','20','21','22','23','24','25','26','27'
                ]
            ],
            [
                'role_id'=>4,
                'permissions'=>[
                    '16','17','18','19','20','21','22','23','24','25','26','27'
                ]
            ],
            [
                'role_id'=>5,
                'permissions'=>[
                    '16','17','18','19','20','21','22','23','24','25','26','27','28'
                ]
            ],
            [
                'role_id'=>6,
                'permissions'=>[
                    '16','17','18','19','20','21','22','23','24','25'
                ]
            ]
        ];
        foreach ($rolePermissions as $rolePermission) {
            $role = Role::find($rolePermission ['role_id']);
            $role->permissions()->attach($rolePermission['permissions']);

        }
    }
}
