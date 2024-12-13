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

    public function edit(Course $course)
    {
        // Ensure the user is authorized to edit this course (check ownership or role)
        // if ($course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        return view('dashboard.courses.edit', compact('course'));
    }

    // Update an existing course
    public function update(Request $request, Course $course)
    {
        // Ensure the user is authorized to update this course (check ownership or role)
        // if ($course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'required|string|max:1000',
        ]);

        // Update the course
        $course->title = $validatedData['course_name'];
        $course->description = $validatedData['course_description'];
        $course->save();

        return redirect()->route('dashboard.courses.index')->with('success', 'Course updated successfully!');
    }

    // Delete a specific course
    public function destroy(Course $course)
    {
        // Ensure the user is authorized to delete this course (check ownership or role)
        // if ($course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Delete the course
        $course->delete();

        return redirect()->route('dashboard.courses.index')->with('success', 'Course deleted successfully!');
    }
    public function index()
    {
        $courses = Course::all(); // Get all courses from the database
        return view('dashboard.courses.courseList', compact('courses')); // Pass courses to the index view
    }


}
