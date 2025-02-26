<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlessonController extends Controller
{
    public function __construct()
    {
        // Share courses with all views
        view()->composer('*', function ($view) {
            $view->with('courses', Course::with('lessons')->get());
        });
    }

    public function index()
    {
        return view('student.lessons.index', [
            'activeMenu' => 'lessons'
        ]);
    }

    public function show(Course $course, Lesson $lesson)
    {
        return view('student.lessons.show', [
            'lesson' => $lesson,
            'course' => $course, // Pass full course object instead of just ID
        ]);
    }
}
