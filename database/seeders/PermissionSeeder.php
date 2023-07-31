<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => '1', 'name' => 'create_user', 'description' => 'Create a new user'],
            ['id' => '2', 'name' => 'view_user', 'description' => 'View user'],
            ['id' => '3', 'name' => 'edit_user', 'description' => 'Edit user'],
            ['id' => '4', 'name' => 'update_user', 'description' => 'Update user'],
            ['id' => '5', 'name' => 'delete_user', 'description' => 'Delete user'],
            ['id' => '6', 'name' => 'create_system', 'description' => 'Create system'],
            ['id' => '7', 'name' => 'view_system', 'description' => 'View system'],
            ['id' => '8', 'name' => 'edit_system', 'description' => 'Edit system'],
            ['id' => '9', 'name' => 'update_system', 'description' => 'Update system'],
            ['id' => '10', 'name' => 'delete_system', 'description' => 'Delete system'],
            ['id' => '11', 'name' => 'create_role', 'description' => 'Create role'],
            ['id' => '12', 'name' => 'view_role', 'description' => 'View role'],
            ['id' => '13', 'name' => 'edit_role', 'description' => 'Edit role'],
            ['id' => '14', 'name' => 'update_role', 'description' => 'Update role'],
            ['id' => '15', 'name' => 'delete_role', 'description' => 'Delete role'],
            ['id' => '16', 'name' => 'create_change_request', 'description' => 'Create change request'],
            ['id' => '17', 'name' => 'view_change_request', 'description' => 'View change request'],
            ['id' => '18', 'name' => 'edit_change_request', 'description' => 'Edit change request'],
            ['id' => '19', 'name' => 'update_change_request', 'description' => 'Update change request'],
            ['id' => '20', 'name' => 'delete_change_request', 'description' => 'Delete change request'],
            ['id' => '21', 'name' => 'create_comment', 'description' => 'Create comment'],
            ['id' => '22', 'name' => 'view_comment', 'description' => 'View comment'],
            ['id' => '23', 'name' => 'edit_comment', 'description' => 'Edit comment'],
            ['id' => '24', 'name' => 'update_comment', 'description' => 'Update comment'],
            ['id' => '25', 'name' => 'delete_comment', 'description' => 'Delete comment'],
            ['id' => '26', 'name' => 'approve_change_request', 'description' => 'Approve change request'],
            ['id' => '27', 'name' => 'reject_change_request', 'description' => 'Reject change request'],
            ['id' => '28', 'name' => 'assign_change_request', 'description' => 'Assign change request'],
        ];
        foreach ($permissions as $permission)
        {Permission::updateOrCreate(
            ['id'=>$permission['id']]
            ,$permission);}
    }
}
