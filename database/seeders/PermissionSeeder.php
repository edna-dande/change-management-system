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
            ['id' => '1', 'name' => 'create_request', 'description' => 'Create a new request'],
            ['id' => '2', 'name' => 'edit_request', 'description' => 'Edit request'],
            ['id' => '3', 'name' => 'delete_request', 'description' => 'Delete request'],

        ];
        foreach ($permissions as $permission)
        {Permission::updateOrCreate(
            ['id'=>$permission['id']]
            ,$permission);}
    }
}
