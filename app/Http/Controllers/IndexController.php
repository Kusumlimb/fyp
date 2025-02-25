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
          $myCourses = auth()->user()->courses()->pluck('course_id')->toArray();
          return view('front.courses')->with([
               'courses' => $courses,
               'myCourses' => $myCourses
          ]);
     }

     public function courseDetail(Course $course)
     {
          $course->load(['instructor', 'lessons'])->loadCount('students');
          $isAlreadyEnrolled = in_array($course->id, auth()->user()->courses()->pluck('id')->toArray());
          return view('front.course-detail')->with([
               'course' => $course,
               'isAlreadyEnrolled' => $isAlreadyEnrolled
          ]);
     }

}
