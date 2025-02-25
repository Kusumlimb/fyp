<?php

namespace App\Http\Controllers\Student;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashController extends Controller
{
    public function index()
    {
        $courses = Course::with(['lessons', 'quizzes'])->get();
        return view('student.index', compact('courses'));
    }
    
}
