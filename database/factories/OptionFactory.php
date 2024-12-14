<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'quiz_id'     => Quiz::factory(),
             'option_text' => $this->faker->word(),
             'is_correct'  => false,
        ];
    }

     public function correct() : OptionFactory|Factory
     {
          return $this->state(function (array $attributes) {
               return [
                    'is_correct' => true,
               ];
          });
     }
}
