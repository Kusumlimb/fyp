<?php

namespace App\Http\Controllers;

use App\Models\Course;

class IndexController extends Controller
{

     public function index()
     {
          return view('front.index');
     }

     public function courses()
     {
          $courses = Course::query()->withCount('students')->get();
          return view('front.courses')->with([
               'courses' => $courses
          ]);
     }

     public function courseDetail(Course $course)
     {
          $course->load(['instructor', 'lessons'])->loadCount('students');
          return view('front.course-detail')->with([
               'course' => $course
          ]);
     }

}
