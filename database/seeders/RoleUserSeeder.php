<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleUsers = [
            ['id' => '1', 'user_id' => '1', 'role_id' => '1']
        ];

        foreach ($roleUsers as $roleUser)
        {RoleUser::updateOrCreate(
            ['id'=>$roleUser['id']]
            ,$roleUser);}
    }
}
