<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{

     public function show(Course $course, Lesson $lesson)
     {
          if(auth()->user()->isStudent() && !auth()->user()->enrolledCourses->contains($course->id)){
               abort(403);
          }
          if(auth()->user()->isTeacher() && !auth()->user()->createdCourses->contains($course->id)){
               abort(403);
          }
          $course->load(['lessons:course_id,slug,title,duration']);
          return view('front.lesson')->with(['course' => $course, 'lesson' => $lesson]);
     }


     public function markComplete(Course $course, Lesson $lesson)
     {
          if(!auth()->user()->enrolledCourses->contains($course->id)){
               abort(403);
          }
          auth()->user()->competedLessons()->syncWithoutDetaching($lesson->id);
          return response()->json(['message' => 'Success']);
     }

}
