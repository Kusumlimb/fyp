<?php
namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlessonController extends Controller
{
    public function index(Course $course) 
{
    $quizzes = $course->quizzes; // Get quizzes for the specific course
    return view('student.quizzes.index', [
        'quizzes' => $quizzes,
        'course' => $course // Pass course to the view
    ]);
}


    public function show(Course $course, Lesson $lesson) // Accepting both course and lesson
    {
        return view('student.lessons.show', [
            'lesson' => $lesson,
            'courseId' => $course->id, // Pass courseId to the view
        ]);
    }
}
