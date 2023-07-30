<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => '1', 'name' => 'admin'],
            ['id' => '2', 'name' => 'user'],
            ['id' => '3', 'name' => 'business analyst'],
            ['id' => '4', 'name' => 'design'],
            ['id' => '5', 'name' => 'tech lead'],
            ['id' => '6', 'name' => 'developer']

        ];

        foreach ($roles as $role)
        {Role::updateOrCreate(
            ['id'=>$role['id']]
            ,$role);}

    }
}
