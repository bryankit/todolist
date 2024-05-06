<?php

namespace Database\Factories;

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
            'user_id'    => 1,
            'title'      => $this->faker->sentence,
            'content'    => $this->faker->paragraph,
            'file_path'  => '',
            'status'     => $this->faker->randomElement(['done', 'in_progress', 'to_do']),
            'publish'    => $this->faker->randomElement(['save_as_draft', 'published']),
            'delete'     => $this->faker->boolean(10),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}