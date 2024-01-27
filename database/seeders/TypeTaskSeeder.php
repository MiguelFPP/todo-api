<?php

namespace Database\Seeders;

use App\Models\TypeTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeTask::create([
            'name' => 'Bug',
            'is_active' => true,
        ]);

        TypeTask::create([
            'name' => 'Feature',
            'is_active' => true,
        ]);

        TypeTask::create([
            'name' => 'Refactor',
            'is_active' => true,
        ]);

        TypeTask::create([
            'name' => 'Test',
            'is_active' => true,
        ]);
    }
}
