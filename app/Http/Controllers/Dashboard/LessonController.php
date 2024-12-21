<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LessonController extends Controller
{
    // Display all lessons
    public function index()
    {
        $data['activeMenu'] = 'lessons';
        $data['lessons'] = Lesson::paginate(5); // Pagination for lessons
        return view('dashboard.lessons.index')->with($data); // Pass lessons to the index view
    }

    // Show the form to create a new lesson
    public function create()
    {
        // Fetch all courses to display in the dropdown
        $courses = Course::all();
        $data['activeMenu'] = 'lessons';
        return view('dashboard.lessons.create', compact('courses'))->with($data);
    }

    // Store a new lesson
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4,mov,avi,mkv,flv|max:10000', // Validate video file type and size (10MB max)
            'course_id' => 'required|exists:courses,id',
        ]);

        // Handle the video file upload
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public'); // Store the video in the 'videos' folder
        }

        // Create the lesson using the validated data
        Lesson::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video_url' => $videoPath, // Store the video path in the database
            'course_id' => $validated['course_id'],
        ]);

        return redirect()->route('dashboard.lessons.index')->with('success', 'Lesson created successfully');
    }

    // Show the form to edit a specific lesson
    public function edit(Lesson $lesson)
    {
        // Fetch all courses to populate the course dropdown
        $courses = Course::all();
        $data['activeMenu'] = 'lessons';
        return view('dashboard.lessons.edit', compact('lesson', 'courses'))->with($data);
    }

    // Update an existing lesson
    public function update(Request $request, Lesson $lesson)
    {
        // Validate the incoming request data, including optional video upload
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|mimes:mp4,mov,avi,mkv,flv|max:10000', // Optional video upload
            'course_id' => 'required|exists:courses,id',
        ]);

        // Handle file upload if a new video is provided
        if ($request->hasFile('video')) {
            // Delete the old video if it exists
            if ($lesson->video_url && file_exists(public_path('storage/'.$lesson->video_url))) {
                unlink(public_path('storage/'.$lesson->video_url));  // Delete the old video
            }

            // Store the new video
            $videoPath = $request->file('video')->store('videos', 'public');
        } else {
            // If no new video, keep the old one
            $videoPath = $lesson->video_url;
        }

        // Update the lesson with the new data
        $lesson->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'course_id' => $validated['course_id'],
            'video_url' => $videoPath,  // Store the video path in the database
        ]);

        return redirect()->route('dashboard.lessons.index')->with('success', 'Lesson updated successfully');
    }

    // Delete a specific lesson
    public function destroy(Lesson $lesson)
    {
        // Ensure the user is authorized to delete this lesson
        // Uncomment the lines below if you want to enforce ownership checks
        // if ($lesson->user_id !== auth()->id()) {
        //     abort(403); // Unauthorized
        // }

        // Delete the lesson
        if ($lesson->video_url && file_exists(public_path('storage/'.$lesson->video_url))) {
            unlink(public_path('storage/'.$lesson->video_url));  // Delete the associated video
        }

        $lesson->delete();

        return redirect()->route('dashboard.lessons.index')->with('success', 'Lesson deleted successfully');
    }
}
