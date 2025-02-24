<?php

namespace App\Http\Controllers\Student;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ScourseController extends Controller
{
    public function index()
    {   
        $data['activeMenu'] = 'courses';
        
        $data['courses']  = Course::with('lessons', 'quizzes')->get();
        return view('student.courses.index')->with($data);
    }

    public function show(Course $course)
    {
        $lessons = $course->lessons; // Get lessons for the course
        $quizzes = $course->quizzes; // Get quizzes for the course
        return view('student.courses.show', compact('course', 'lessons', 'quizzes'));
    }
    
}
