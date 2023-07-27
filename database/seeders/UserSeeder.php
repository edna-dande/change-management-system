<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['id' => '1', 'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => '12345678'],
        ];

        foreach ($users as $user)
        {User::updateOrCreate(
            ['id'=>$user['id']]
            ,$user);}
    }
}
