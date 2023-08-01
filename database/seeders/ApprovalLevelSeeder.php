<?php

namespace Database\Seeders;

use App\Models\ApprovalLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvalLevels = [
            ['id' => '1', 'type' => 'BSA'],
            ['id' => '2', 'type' => 'Design'],
            ['id' => '3', 'type' => 'Tech Lead'],
        ];
        foreach ($approvalLevels as $approvalLevel)
        {ApprovalLevel::updateOrCreate(
            ['id'=>$approvalLevel['id']]
            ,$approvalLevel);}

    }
}
