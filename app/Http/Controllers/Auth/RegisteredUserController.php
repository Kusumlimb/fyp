<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Course;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $courses = Course::all(); // Fetch all courses
    return view('auth.register', compact('courses'));
}

    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role'     => ['required', 'in:teacher,student,admin'],
        'course_id' => ['nullable', 'exists:courses,id'], // Validate course selection
    ]);

    $user = User::query()->create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
        'course_id' => $request->role === 'student' ? $request->course_id : null, // Only assign course if role is student
    ]);

    event(new Registered($user));
    Auth::login($user);

    return match ($user->role) {
        'teacher' => redirect()->intended(route('dashboard.index', absolute: false)),
        'student' => redirect()->intended(route('payment.payment', absolute: false)),
        'admin'   => redirect()->intended(route('admin.index', absolute: false)),
        default   => redirect()->route('home'),
    };
}

}
