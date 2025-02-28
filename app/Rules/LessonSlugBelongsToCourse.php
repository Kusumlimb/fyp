<?php

namespace App\Rules;

use App\Models\Course;
use App\Models\Lesson;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class LessonSlugBelongsToCourse implements ValidationRule
{

     public function __construct(protected Course $course)
     {

     }
     /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void{
         if (!Lesson::query()->where('slug', $value)->where('course_id', $this->course->id)->exists()) {
              $fail("The lesson slug {$value} does not belong to this course.");
         }
    }

}
