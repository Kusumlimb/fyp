<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{

     public function show(Course $course, Lesson $lesson)
     {
          return view('front.lesson')->with(['course' => $course, 'lesson' => $lesson]);
     }

}
