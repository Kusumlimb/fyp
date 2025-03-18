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
    
    public function showProgress(Course $course)
{
    $user = auth()->user();

    $isAlreadyEnrolled = $course->students()->where('user_id', $user->id)->exists();
    $isCreator = $course->instructor_id === $user->id;

    if (! $isAlreadyEnrolled && ! $isCreator) {
        abort(403, 'Unauthorized');
    }

  
    return view('student.courses.progress', [
        'course' => $course,
    ]);
}

}
