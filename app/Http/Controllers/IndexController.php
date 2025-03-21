<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Course;

class IndexController extends Controller
{

     public function index()
{
    $recommendedCourses = [];

    if (auth()->check()) {
        $user = auth()->user();

        // Get instructor user_ids from enrolled courses
        $instructorIds = $user->enrolledCourses->pluck('user_id')->unique();

        $recommendedCourses = Course::where('status', Status::ACTIVE->value)
            ->whereIn('user_id', $instructorIds)
            ->whereNotIn('id', $user->enrolledCourses->pluck('id')) // skip already enrolled ones
            ->limit(5)
            ->get();
    }

    return view('front.index', compact('recommendedCourses'));
}



     public function courses()
     {
          $courses = Course::query()->where('status', Status::ACTIVE->value)->withCount('students')->get();
          $myCourses = auth()->user()?->enrolledCourses->pluck('course_id')->toArray() ?? [];
          return view('front.courses')->with([
               'courses' => $courses,
               'myCourses' => $myCourses
          ]);
     }

     public function courseDetail(Course $course)
     {
          if($course->status !== Status::ACTIVE){
               abort(403);
          }
          $course->load(['instructor', 'lessons'])->loadCount('students');
          $isAlreadyEnrolled = auth()->user()?->enrolledCourses->contains($course->id);
          $isCreator = auth()->user()?->createdCourses->contains($course->id);
          $completedLessons = auth()->user()->isStudent() ? auth()->user()->competedLessons->pluck('slug')->toArray() : [];
          return view('front.course-detail')->with([
               'course' => $course,
               'isCreator' => $isCreator,
               'isAlreadyEnrolled' => $isAlreadyEnrolled,
               'completedLessons' => $completedLessons
          ]);
     }

     public function blogs(){
          return view('front.blogs');
     }

     public function contact()
     {
          return view('front.contact');
     }

}
