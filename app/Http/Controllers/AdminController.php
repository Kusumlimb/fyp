<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.index');
    }

    public function show()
    {
        $data['activeMenu'] = 'users';
        $data['users'] = User::where('role', '!=', 'admin')->get();  
        return view('admin.users', $data);
    }
    


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function courses()
    {
        $data['activeMenu'] = 'courses';
        $data['courses'] = Course::all();
        return view('admin.courses', $data);
    }

    // Delete a course along with its lessons
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->lessons()->delete(); // Delete associated lessons
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully');
    }


    public function lessons()
    {
        $data['activeMenu'] = 'lessons';
        $data['lessons'] = Lesson::with('course')->get();
        return view('admin.lessons', $data);
    }

  
    public function deleteLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('admin.lessons')->with('success', 'Lesson deleted successfully');
    }
}
