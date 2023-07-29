<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['id' => '1', 'name' => 'low'],
            ['id' => '2', 'name' => 'medium'],
            ['id' => '3', 'name' => 'high'],
        ];

        foreach ($priorities as $priority)
        {Priority::updateOrCreate(
            ['id'=>$priority['id']]
            ,$priority);}
    }
}
