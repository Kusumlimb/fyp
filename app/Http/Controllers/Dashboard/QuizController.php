<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

     public function index()
     {
          $data['activeMenu'] = 'quiz';
          $data['quizzes'] = Quiz::query()->with('course')->paginate(5);
          return view('dashboard.quiz.index')->with($data);
     }

     public function create()
     {

     }

     public function store()
     {

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
               'options.*.is_correct'  => ['nullable', 'boolean'],
          ]);

          $quiz->update([
               'title'   => $request->input('quiz_title'),
          ]);

          foreach($request->input('options') as $option){
               Option::query()->where('id', $option['option_id'])->update([
                    'option_text'  => $option['option_text'],
                    'is_correct'   => $option['is_correct'],
               ]);
          }


          return redirect()->route('dashboard.quiz.index')->with('success', 'Quiz updated successfully');

     }

     public function destroy(Course $course){

     }
}
