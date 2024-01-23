<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Priority;
use App\Models\StatusTask;
use App\Models\Task;
use App\Models\TypeTask;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([UserSeeder::class]);
        Priority::factory(3)->create();
        TypeTask::factory(4)->create();
        StatusTask::factory(4)->create();
        Task::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
