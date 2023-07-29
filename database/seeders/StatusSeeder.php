<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => '1', 'name' => 'Pending'],
            ['id' => '2', 'name' => 'In Progress'],
            ['id' => '3', 'name' => 'Completed'],

        ];

        foreach ($statuses as $status)
        {Status::updateOrCreate(
            ['id'=>$status['id']]
            ,$status);}
    }
}
