<?php
namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlessonController extends Controller
{
    public function index() // Accepting course as a parameter
    {
        $courses= Course::with('lessons')->get();
       
        return view('student.lessons.index', [
            'courses' => $courses,
            'activeMenu'=> 'lessons'
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
