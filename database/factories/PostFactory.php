<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => fake()->realText(30),
            'description' => fake()->realText(200),
            'image' => fake()->image(),
            'contact' => fake()->safeEmail(),
            'anonymous' => fake()->numberBetween(0, 1),
            'status' => fake()->randomElement(['รอดำเนินการ','กำลังดำเนินการ','เสร็จสิ้น']),
            'vote_count' => fake()->numberBetween(0, 1000)
        ];
    }
}
