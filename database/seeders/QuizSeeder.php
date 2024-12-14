<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Course::factory(20)->create()->each(function ($course) {
              $quizzes = Quiz::factory(5)->create(['course_id' => $course->id]);
              $quizzes->each(function ($quiz) {
                   Option::factory(3)->create(['quiz_id' => $quiz->id]);
                   Option::factory()->correct()->create(['quiz_id' => $quiz->id]);
              });
         });
    }
}
