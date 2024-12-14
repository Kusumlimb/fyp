<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
     public function index()
     {
          $data['activeMenu'] = 'lessons';
          $data['lessons'] =  Lesson::all();
          return view('dashboard.lessons.lessonList')->with($data); // Pass lessons to the index view
     }

     public function create()
    {
        // Fetch all courses to display in the dropdown
        $courses = Course::all();

        // Return the view with the list of all courses
        return view('dashboard.lessons.create', compact('courses'));
    }


    public function store(Request $request)
    {
        // Validate the request, including the video upload
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4,mov,avi,mkv,flv|max:10000', // Validate video file type and size (10MB max)
            'course_id' => 'required|exists:courses,id',
        ]);

        // Handle the file upload
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public'); // Store the video in the 'videos' folder
        }

        // Create the lesson with the provided data
        Lesson::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video_url' => $videoPath, // Store the video path in the database
            'course_id' => $validated['course_id'],
        ]);

        return redirect()->route('dashboard.lessons.create')->with('success', 'Lesson created successfully');
    }

    public function edit(Lesson $lesson)
    {
        // // Ensure the user is authorized to edit this lesson
        // if ($lesson->course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Fetch all courses to populate the course dropdown
        $courses = Course::all();

        // Return the view with lesson and courses data
        return view('dashboard.lessons.edit', compact('lesson', 'courses'));
    }

    // Update a specific lesson
    public function update(Request $request, Lesson $lesson)
    {
        // dd($request->all());
        // Ensure the user is authorized to update this lesson
        // if ($lesson->course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Validate the request, including optional video upload
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4,mov,avi,mkv,flv|max:10000',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Handle file upload if a new video is provided
        if ($request->hasFile('video')) {

        
            // Delete the old video if it exists
            if ($lesson->video_url && file_exists(public_path('storage/'.$lesson->video_url))) {
            
                unlink(public_path('storage/'.$lesson->video_url));  // Delete old video
            }
           

        // Store the new video
           
       
            $videoPath = Storage::put('videos', $request->file('video'));
         
        } else {
        // Keep the old video if no new file is uploaded
        $videoPath = $lesson->video_url;  // This assumes you have a 'video_path' column
        }

      

    // Update the lesson with the new data
        $lesson->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'course_id' => $validated['course_id'],
        'video_url' => $videoPath,  // Store the video path
        ]);
        return redirect()->route('dashboard.lessons.index')->with('success', 'Lesson updated successfully');
    }

    // Delete a specific lesson
    public function destroy(Lesson $lesson)
    {
        // Ensure the user is authorized to delete this lesson
        // if ($lesson->course->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Delete the lesson
        $lesson->delete();

        return redirect()->route('dashboard.lessons.index')->with('success', 'Lesson deleted successfully');
    }


}
