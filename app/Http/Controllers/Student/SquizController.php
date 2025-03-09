<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
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

    public function submitQuiz(Request $request, Course $course) {
        $user = Auth::user();

    
        // Check if user has already taken the quiz
        if (QuizAttempt::where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.quizzes.index', ['course' => $course->id])
                ->with('error', 'You have already taken this quiz.');
        }
    
        $answers = $request->input('answers', []);
        $quizzes = Quiz::where('course_id', $course->id)->get();
    
        $correctAnswers = 0;
        $totalQuestions = $quizzes->count();
    
        foreach ($quizzes as $quiz) {
            $correctOption = $quiz->options()->where('is_correct', true)->first();
            if (isset($answers[$quiz->id]) && $answers[$quiz->id] == $correctOption->id) {
                $correctAnswers++;
            }
        }
    
        // Mark quiz as completed
        QuizAttempt::create([
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);
    
        return redirect()->route('student.quizzes.index', ['course' => $course->id])
            ->with('success', "You got $correctAnswers out of $totalQuestions correct!");
    }


}
  





