<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'user_id' =>  UserFactory::class,
             'title'       => $this->faker->unique()->word(),
             'description' => $this->faker->paragraph(),
             'price'       => $this->faker->randomNumber(2),
        ];
    }
}
