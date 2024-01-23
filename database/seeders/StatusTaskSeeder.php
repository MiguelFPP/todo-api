<?php

namespace Database\Seeders;

use App\Models\StatusTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusTask::create([
            'name' => 'pending',
            'is_active' => true,
        ]);

        StatusTask::create([
            'name' => 'initialized',
            'is_active' => true,
        ]);

        StatusTask::create([
            'name' => 'in progress',
            'is_active' => true,
        ]);

        StatusTask::create([
            'name' => 'completed',
            'is_active' => true,
        ]);
    }
}
