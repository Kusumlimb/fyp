<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
     public function index()
     {
          $data['activeMenu'] = 'courses';
          $data['courses'] =  Course::query()->paginate(5); // Get all courses from the database
          return view('dashboard.courses.index')->with($data); // Pass courses to the index view
     }


     public function create()
    {
        $data['activeMenu'] = 'courses';
        $data['course'] = new Course();
        return view('dashboard.courses.create')->with($data);
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
             'course_name'        => 'required|string|unique:courses,title|max:255',
             'course_description' => 'required|string|max:1000',
        ]);

        // Create a new course using the validated data
        $course = new Course();
        $course->title = $validatedData['course_name'];
        $course->description = $validatedData['course_description'];
        $course->save();
  
        return redirect()->route('dashboard.courses.index')->with('success', 'Course created successfully!');
   
    }

    public function edit(Course $course)
    {
        // Ensure the user is authorized to edit this course (check ownership or role)
        // if ($course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        $data['activeMenu'] = 'courses';
        $data['course'] = $course;
        return view('dashboard.courses.edit')->with($data);
    }

    // Update an existing course
    public function update(Request $request, Course $course)
    {
        // Ensure the user is authorized to update this course (check ownership or role)
        // if ($course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }
        $validatedData = $request->validate([
             'course_name'        =>  [
                  'required',
                  'string',
                  'max:255',
                  Rule::unique('courses', 'title')->ignore($course->id), // Ensure uniqueness while ignoring the current course
             ],
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

}
