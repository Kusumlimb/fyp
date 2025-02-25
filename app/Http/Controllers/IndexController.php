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

}
