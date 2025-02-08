<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
     public function index()
     {
          $data['activeMenu'] = 'courses';
          $data['courses'] =  Course::query()->paginate(5); // Get all courses from the database
          return view('dashboard.courses.index')->with($data); // Pass courses to the index view
     }
}