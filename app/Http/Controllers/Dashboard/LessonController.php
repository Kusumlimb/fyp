<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
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
    }
