<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SquizController extends Controller
{
    public function index(Course $course)
    {
        
        $quizzes = $course->quizzes; 
        return view('student.quizzes.index', [
            'quizzes' => $quizzes,
            'course' => $course, 
        ]);
    }

    public function show(Course $course, Quiz $quiz)
    {
        $quiz->load('questions.options'); 

        return view('student.quizzes.show', [
            'course' => $course,
            'quiz' => $quiz
        ]);
    }

    public function submitQuiz(Request $request, Course $course)
{
    $user = Auth::user();
    $answers = $request->input('answers', []);

    
    $quizzes = Quiz::where('course_id', $course->id)->with('options')->get();

    $correctAnswers = 0;
    $totalQuestions = $quizzes->count();

    foreach ($quizzes as $quiz) {
        $selectedOptionId = $answers[$quiz->id] ?? null;

        $correctOption = $quiz->options->where('is_correct', true)->first();

        if ($selectedOptionId && $correctOption && $selectedOptionId == $correctOption->id) {
            $correctAnswers++;
        }
    }

    $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

    QuizAttempt::create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'score' => $score,
        'total_questions' => $totalQuestions,
    ]);

    return redirect()->route('student.quizzes.index', ['course' => $course->id])
        ->with('success', "You scored $score%");
}


public function quizResults(Course $course)
{
    $user = Auth::user();
    $attempts = QuizAttempt::where('user_id', $user->id)->where('course_id', $course->id)->orderBy('created_at', 'desc')->get();

    return view('student.quizzes.results', compact('attempts', 'course'));
}




}
  





