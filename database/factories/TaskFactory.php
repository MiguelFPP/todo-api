<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\StatusTask;
use App\Models\TypeTask;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'priority_id' => $this->faker->randomElement(Priority::pluck('id')->toArray()),
            'type_task_id' => $this->faker->randomElement(TypeTask::pluck('id')->toArray()),
            'status_task_id' => $this->faker->randomElement(StatusTask::pluck('id')->toArray()),
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
