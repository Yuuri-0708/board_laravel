<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Threads>
 */
class ThreadsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeThisDecade;
        return [
            'thread_name' => $this->faker->realText(80), 
            'user_id' => rand(1, User::count()), 
            'show_count' => rand(1, 1000), 
            'status' => $this->faker->boolean,
            'created_at' => $created_at, 
            'updated_at' => $created_at
        ];
    }
}
