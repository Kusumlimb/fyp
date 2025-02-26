<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\Dashboard\QuizController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Student\DashController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ScourseController;
use App\Http\Controllers\Student\SlessonController;
use App\Http\Controllers\Student\SquizController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController as ControllersStudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about/language', function () {
     return view('about.language');
 });

 Route::get('/about/blog', function () {
     return view('about.blog');
 });
 
 Route::get('/about/contact', function () {
     return view('about.contact');
 });
 
 Route::get('/about/languages/spanish', function () {
     return view('about.languages.spanish');
 })->name('languages.spanish');
 Route::get('/about/languages/dutch', function () {
    return view('about.languages.dutch');
})->name('languages.dutch');
Route::get('/about/languages/french', function () {
    return view('about.languages.french');
})->name('languages.french');
Route::get('/about/languages/german', function () {
    return view('about.languages.german');
})->name('languages.german');
Route::get('/about/languages/italian', function () {
    return view('about.languages.italian');
})->name('languages.italian');
Route::get('/about/languages/portuguese', function () {
    return view('about.languages.portuguese');
})->name('languages.portuguese');
Route::get('/about/languages/english', function () {
    return view('about.languages.english');
})->name('languages.english');
Route::get('/about/languages/danish', function () {
    return view('about.languages.danish');
})->name('languages.danish');
 
Route::middleware(['auth', 'verified', 'role:teacher'])->group(function(){
     Route::prefix('dashboard')->as('dashboard.')->group(function(){
          Route::get('/', function () {
               return view('dashboard');
          })->name('index');

          Route::prefix('courses')->as('courses.')->group(function(){
               Route::get('/', [CourseController::class, 'index'])->name('index');
               Route::get('create', [CourseController::class, 'create'])->name('create');
               Route::post('/', [CourseController::class, 'store'])->name('store');
               Route::get('{course}/edit', [CourseController::class, 'edit'])->name('edit');
               Route::put('{course}', [CourseController::class, 'update'])->name('update');
               Route::delete('{course}', [CourseController::class, 'destroy'])->name('destroy');
          });

          Route::prefix('lessons')->as('lessons.')->group(function () {
               Route::get('/', [LessonController::class, 'index'])->name('index');
               Route::get('create', [LessonController::class, 'create'])->name('create');
               Route::post('/', [LessonController::class, 'store'])->name('store');
               Route::get('{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
               Route::put('{lesson}', [LessonController::class, 'update'])->name('update');
               Route::delete('{lesson}', [LessonController::class, 'destroy'])->name('destroy');
          });

          Route::prefix('quizzes')->as('quiz.')->group(function(){
               Route::get('/', [QuizController::class, 'index'])->name('index');
               Route::get('create/course/{course}', [QuizController::class, 'create'])->name('create');
               Route::post('/course/{course}', [QuizController::class, 'store'])->name('store');
               Route::get('{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
               Route::put('{quiz}', [QuizController::class, 'update'])->name('update');
               Route::delete('{quiz}', [QuizController::class, 'destroy'])->name('destroy');

          });
     });
});

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/student/index', [DashController::class, 'index'])->name('student.index');

    Route::get('/student/courses', [ScourseController::class, 'index'])->name('student.courses.index');
    Route::get('/student/courses/{course}', [ScourseController::class, 'show'])->name('student.courses.show');


    // Grouping routes under 'student/courses/{course}' prefix for Lessons
    Route::prefix('student/courses/{course}')->group(function () {
        Route::get('/lessons', [SlessonController::class, 'index'])->name('student.lessons.index');
        Route::get('/lessons/{lesson}', [SlessonController::class, 'show'])->name('student.lessons.show');
    });
    


// Grouping routes under 'student/courses/{course}' prefix for Quizzes
Route::prefix('student/courses/{course}')->group(function () {
    Route::get('/quizzes', [SquizController::class, 'index'])->name('student.quizzes.index');
    Route::get('/quizzes/{quiz}', [SquizController::class, 'show'])->name('student.quizzes.show');
});

    
});
 

 Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'show'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::delete('/admin/courses/{id}', [AdminController::class, 'deleteCourse'])->name('admin.deleteCourse');
    Route::get('/admin/lessons', [AdminController::class, 'lessons'])->name('admin.lessons');
    Route::delete('/admin/lessons/{id}', [AdminController::class, 'deleteLesson'])->name('admin.deleteLesson');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Khalti Payment Routes
Route::post('/khalti/payment', [PaymentController::class, 'verifyPayment'])->name('khalti.payment');

Route::get('/payment/payment', function () {
    return view('payment.payment'); 
})->name('payment.payment');


Route::get('/thank-you', function () {
    return view('thank-you'); 
})->name('thank-you');
require __DIR__.'/auth.php';
