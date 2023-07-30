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
            ['id' => '2', 'name' => 'In Progress, Pending Design Approval'],
            ['id' => '3', 'name' => 'In Progress, Pending Tech Lead Approval'],
            ['id' => '4', 'name' => 'Completed'],
            ['id' => '5', 'name' => 'Rejected']

        ];

        foreach ($statuses as $status)
        {Status::updateOrCreate(
            ['id'=>$status['id']]
            ,$status);}
    }
}
