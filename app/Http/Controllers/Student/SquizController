<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SquizController extends Controller
{
    public function index(Course $course)
    {
        $quizzes = $course->quizzes; // Get quizzes for the specific course
        return view('student.quizzes.index', [
            'quizzes' => $quizzes,
            'courseId' => $course->id, // Pass courseId to the view
        ]);
    }

    public function show(Course $course, Quiz $quiz)
    {
        return view('student.quizzes.show', [
            'quiz' => $quiz,
            'courseId' => $course->id, // Pass courseId to the view
        ]);
    }
}

