<?php

namespace App\Http\Controllers\Dashboard;
use App\Enums\Role;
use App\Enums\Status;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
     public function index()
     {
          $data['activeMenu'] = 'courses';
          $data['courses'] =  Course::query()->select('courses.id', 'slug','thumbnail', 'title', 'price', 'courses.created_at', 'status')->when(auth()->user()->role ===
               Role::TEACHER,
               function
          ($query){
               $query->where('user_id', auth()->user()->id);
          })->when(auth()->user()->role === Role::ADMIN, function($query){
               $query->join('users', 'courses.user_id', '=', 'users.id')
               ->addSelect('users.name as instructor_name');
          })->paginate(5);
          return view('dashboard.courses.index')->with($data);
     }


     public function create()
    {
         if(!auth()->user()->isTeacher()){
              abort(403);
         }
        $data['activeMenu'] = 'courses';
        $data['course'] = new Course();
        return view('dashboard.courses.create')->with($data);
    }


    public function store(Request $request)
    {
         if(!auth()->user()->isTeacher()){
              abort(403);
         }
        $validatedData = $request->validate([
             'course_name'        => ['required', 'string', 'unique:courses,title', 'max:255'],
             'course_description' => ['required', 'string', 'max:1000'],
             'thumbnail'          => ['required', 'image', 'max:2048'],
             'course_price'               => ['required', 'numeric', 'min:10'],
        ]);
        $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        Course::query()->create([
             'title'       => $validatedData['course_name'],
             'description' => $validatedData['course_description'],
             'status'      => Status::PENDING->value,
             'thumbnail'   => $thumbnailPath,
             'price'       => $validatedData['course_price'] * 100,
             'user_id'     => auth()->user()->id
        ]);
        return redirect()->route('dashboard.courses.index')->with('toastr.success', 'Course created successfully!');
   
    }

    public function edit(Course $course)
    {
         if ($course->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
              abort(403);
         }
        $data['activeMenu'] = 'courses';
        $data['course'] = $course;
        return view('dashboard.courses.edit')->with($data);
    }

    public function update(Request $request, Course $course)
    {
         if ($course->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
              abort(403);
         }
        $validatedData = $request->validate([
             'course_name'        => ['required', 'string', 'max:255', Rule::unique('courses', 'title')->ignore($course->id)],
             'course_description' => ['required', 'string', 'max:1000'],
             'thumbnail'          => ['required_without:thumbnail_old', 'image', 'max:2048'],
             'course_price'       => ['required', 'numeric', 'min:10'],
        ]);

         $thumbnailPath = $course->thumbnail;
        if($request->hasFile('thumbnail')){
             Storage::disk('public')->delete($thumbnailPath);
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        Course::query()->where('id', $course->id)->update([
             'title'       => $validatedData['course_name'],
             'description' => $validatedData['course_description'],
             'price'       => $validatedData['course_price'] * 100,
             'thumbnail'   => $thumbnailPath,
        ]);

        return redirect()->route('dashboard.courses.index')->with('toastr.success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
         if ($course->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
             abort(403);
         }
         Storage::disk('public')->delete($course->thumbnail);
         $course->delete();
        return redirect()->route('dashboard.courses.index')->with('success', 'Course deleted successfully!');
    }

     public function updateStatus(Course $course, Request $request)
     {
          if (!auth()->user()->isAdmin()) {
               abort(403);
          }
          $request->validate([
               'status' => [Rule::enum(Status::class)],
          ]);
          $course->update([
               'status' => $request->input('status'),
          ]);
          return response()->json([
               'message' => 'Course status updated successfully!'
          ]);
     }

}
