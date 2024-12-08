<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function create()
    {
       
        return view('dashboard.courses.create');
    }


    public function store(Request $request)
{
   
    // Validate the incoming request data
    $validatedData = $request->validate([
        'course_name' => 'required|string|max:255',
        'course_description' => 'required|string|max:1000',
    ]);

    

    
    // Create a new course using the validated data
    $course = new Course();
    $course->title = $validatedData['course_name'];
    $course->description = $validatedData['course_description'];
    $course->save();

  
    return redirect()->back()->with('success', 'Course created successfully!');
   
}


}
