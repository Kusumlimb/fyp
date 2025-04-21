<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\Lesson;
use App\Rules\LessonSlugBelongsToCourse;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $data['activeMenu'] = 'courses';
        $data['course'] = $course;
        $data['lessons'] = Lesson::query()->where('course_id', $course->id)->get();
        return view('dashboard.lessons.index')->with($data);
    }

    public function create(Course $course)
    {
         $data['activeMenu'] = 'courses';
         $data['course'] = $course;
         $data['lesson'] = new Lesson();
         return view('dashboard.lessons.create')->with($data);
    }

    public function store(Course $course, Request $request)
    { 
     
        $validated = $request->validate([
             'title'       => ['required', 'string', 'max:255'],
             'description' => ['required', 'string'],
             'video'       => ['required', 'mimes:mp4,mov,avi,mkv,flv', 'max:1000000'],
        ]);
         $maxOrder = Lesson::query()->where('course_id', $course->id)->max('order');
         $videoPath = $request->file('video')->store("courses/{$course->slug}/lessons", 'public');
         $ffProbe = FFProbe::create();
         $videoDuration = $ffProbe->format(public_path("storage/$videoPath"))->get('duration');
         Lesson::query()->create([
              'title'       => $validated['title'],
              'description' => $validated['description'],
              'course_id'   => $course->id,
              'order'       => $maxOrder + 1,
              'video_url'   => $videoPath,
              'duration'    => round($videoDuration),
        ]);
        return redirect()->route('dashboard.courses.lessons.index', $course->slug)->with('toastr.success', 'Lesson created successfully');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $data['activeMenu'] = 'courses';
        $data['course'] = $course;
        $data['lesson'] = $lesson;
        return view('dashboard.lessons.edit')->with($data);
    }

    public function update(Course $course, Lesson $lesson, Request $request)
    {
        $validated = $request->validate([
             'title'       => ['required', 'string', 'max:255'],
             'description' => ['required', 'string'],
             'video'       => ['required_without:video_url_old', 'mimes:mp4,mov,avi,mkv,flv', 'max:50000'],
        ]);

         $videoPath = $lesson->video_url;
         $videoDuration = $lesson->duration;
        if ($request->hasFile('video')) {
             Storage::disk('public')->delete($lesson->video_url);
             $videoPath = $request->file('video')->store("courses/{$course->slug}/lessons", 'public');
             $ffProbe = FFProbe::create();
             $videoDuration = $ffProbe->format(public_path("storage/$videoPath"))->get('duration');
        }
        $lesson->update([
             'title'       => $validated['title'],
             'description' => $validated['description'],
             'video_url'   => $videoPath,
             'duration'    => round($videoDuration),
        ]);

        return redirect()->route('dashboard.courses.lessons.index', $course->slug)->with('toastr.success', 'Lesson updated successfully');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        Storage::disk('public')->delete($lesson->video_url);
        $lesson->delete();
        return redirect()->route('dashboard.courses.lessons.index', ['course' => $course, 'lesson' => $lesson])->with('toastr.success', 'Lesson deleted successfully');
    }

     public function reorder(Course $course, Request $request)
     {
          $request->validate([
               'sorted_lessons' => ['required', 'array'],
               'sorted_lessons.*' => [new LessonSlugBelongsToCourse($course)],
          ]);
          $sortedLessons = $request->input('sorted_lessons');
          DB::transaction(function () use ($sortedLessons) {
               foreach ($sortedLessons as $index => $slug) {
                    Lesson::query()->where('slug', $slug)->update(['order' => $index + 1]);
               }
          });
          return response()->json(['message' => 'Reordered lessons successfully']);

     }
}
