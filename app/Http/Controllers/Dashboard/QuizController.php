<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Option;
use App\Models\Quiz;
use App\Rules\Dashboard\CorrectOptionRule;
use Illuminate\Http\Request;

class QuizController extends Controller
{

     public function index()
     {
          $data['activeMenu'] = 'quiz';
          $data['quizzes'] = Quiz::query()->with('course')->paginate(5);
          return view('dashboard.quiz.index')->with($data);
     }

     public function create(Request $request, Course $course)
     {
          $data['activeMenu'] = 'quiz';
          $data['quiz'] = new Quiz();
          $data['course'] = $course;
          return view('dashboard.quiz.create')->with($data);
     }

     public function store(Request $request, Course $course)
     {
          $request->validate([
               'quiz_title'            => ['required', 'string', 'max:255'],
               'options'               => ['required', 'array', 'size:4'],
               'options.*.option_text' => ['required', 'string', 'max:255'],
               'correct_option'        => ['required', 'in:1,2,3,4']
          ], [], [
               'options.*.option_text' => 'Option text',
          ]);


          $quiz = $course->quizzes()->create([
               'title'   => $request->input('quiz_title'),
          ]);

          foreach($request->input('options') as $key => $option){
               Option::query()->create([
                    'option_text'  => $option['option_text'],
                    'is_correct'   => intval($request->input('correct_option')) === $key,
                    'quiz_id'      => $quiz->id,
               ]);
          }

          return redirect()->route('dashboard.quiz.index')->with('success', 'Quiz updated successfully');
     }
     public function edit(Quiz $quiz)
     {
          $quiz->load('options');
          $data['activeMenu'] = 'quiz';
          $data['quiz'] = $quiz;
          return view('dashboard.quiz.edit')->with($data);
     }

     public function update(Quiz $quiz, Request $request)
     {

          $request->validate([
               'quiz_title'            => ['required', 'string', 'max:255'],
               'options'               => ['required', 'array', 'size:4'],
               'options.*.option_id'   => ['required', 'exists:options,id'],
               'options.*.option_text' => ['required', 'string', 'max:255'],
               'correct_option'        => ['required', 'exists:options,id']
          ], [], [
               'options.*.option_text' => 'Option text',
          ]);

          $quiz->update([
               'title'   => $request->input('quiz_title'),
          ]);

          foreach($request->input('options') as $option){
               Option::query()->where('id', $option['option_id'])->update([
                    'option_text'  => $option['option_text'],
                    'is_correct'   => $request->input('correct_option') === $option['option_id'],
               ]);
          }

          return redirect()->route('dashboard.quiz.index')->with('success', 'Quiz updated successfully');

     }

     public function destroy(Course $course){

     }
}
