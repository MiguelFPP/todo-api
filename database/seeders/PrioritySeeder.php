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
        Priority::create([
            'name' => 'low',
            'is_active' => true,
        ]);

        Priority::create([
            'name' => 'medium',
            'is_active' => true,
        ]);

        Priority::create([
            'name' => 'high',
            'is_active' => true,
        ]);
    }
}
