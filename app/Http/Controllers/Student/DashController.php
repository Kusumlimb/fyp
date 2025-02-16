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
        // Fetch courses with lessons and quizzes (since quizzes are related to courses directly)
        $courses = Course::with(['lessons', 'quizzes'])->get(); 
        
        // Return the view with the courses data
        return view('student.index', compact('courses'));
    }
    
}
