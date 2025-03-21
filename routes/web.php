<?php

use App\Enums\Role;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\Dashboard\QuizController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ScourseController;
use App\Http\Controllers\Student\SlessonController;
use App\Http\Controllers\Student\SquizController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController as FrontLessonController;


$teacherRole = Role::TEACHER->value;
$adminRole = Role::ADMIN->value;
$studentRole = Role::STUDENT->value;

Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/languages', [IndexController::class, 'courses'] )->name('front.courses');
Route::get('/blogs', [IndexController::class, 'blogs'] )->name('front.blogs');
Route::get('/languages', [IndexController::class, 'courses'] )->name('front.courses');
Route::get('/contact', [IndexController::class, 'contact'] )->name('front.contact');
Route::get('/languages/{course:slug}', [IndexController::class, 'courseDetail'] )->name('front.courses.course-detail');

Route::middleware(['auth'])->group(function(){
     Route::get('languages/{course:slug}/{lesson:slug}', [FrontLessonController::class, 'show'])->name('front.courses.lessons.view');
});

Route::middleware(['auth', "role:$studentRole"])->group(function(){
     Route::post('initiate-payment/{course:slug}', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
     Route::get('payment-confirmation', [PaymentController::class, 'verifyPayment'])->name('payment.verify-payment');
     Route::put('languages/{course:slug}/{lesson:slug}/mark-complete', [FrontLessonController::class, 'markComplete'])->name('front.courses.mark-complete');
});

Route::middleware(['auth', "role:$adminRole"])->group(function(){
     Route::put('course/{course:slug}/update-status', [CourseController::class, 'updateStatus'])->name('dashboard.courses.update-status');

     Route::prefix('users')->as('dashboard.users.')->group(function(){
          Route::get('/', [UserController::class, 'index'])->name('index');
          Route::get('create', [UserController::class, 'create'])->name('create');
          Route::post('/', [UserController::class, 'store'])->name('store');
          Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
          Route::put('{user}', [UserController::class, 'update'])->name('update');
          Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
     });

});

Route::middleware(['auth', 'verified', "role:$teacherRole,$adminRole"])->group(function(){
     Route::prefix('dashboard')->as('dashboard.')->group(function(){
          Route::get('/', [DashboardController::class, 'index'])->name('index');

          Route::prefix('courses')->as('courses.')->group(function(){
               Route::get('/', [CourseController::class, 'index'])->name('index');
               Route::get('create', [CourseController::class, 'create'])->name('create');
               Route::post('/', [CourseController::class, 'store'])->name('store');
               Route::get('{course:slug}/edit', [CourseController::class, 'edit'])->name('edit');
               Route::put('{course:slug}', [CourseController::class, 'update'])->name('update');
               Route::delete('{course:slug}', [CourseController::class, 'destroy'])->name('destroy');


               Route::prefix('{course:slug}/lessons')->as('lessons.')->group(function () {
                    Route::get('/', [LessonController::class, 'index'])->name('index');
                    Route::get('create', [LessonController::class, 'create'])->name('create');
                    Route::post('/', [LessonController::class, 'store'])->name('store');
                    Route::get('re-order', [LessonController::class, 'reOrder'])->name('re-order');
                    Route::get('{lesson:slug}/edit', [LessonController::class, 'edit'])->name('edit');
                    Route::put('{lesson:slug}', [LessonController::class, 'update'])->name('update');
                    Route::delete('{lesson:slug}', [LessonController::class, 'destroy'])->name('destroy');
               });

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


    Route::get('/student/courses', [ScourseController::class, 'index'])->name('student.courses.index');
    Route::get('/student/courses/{course}', [ScourseController::class, 'show'])->name('student.courses.show');


    // Grouping routes under 'student/courses/{course}' prefix for Lessons
    Route::get('student/courses/lessons/list', [SlessonController::class, 'index'])->name('student.lessons.index');
Route::prefix('student/courses/{course}')->group(function () {
    
    Route::get('/lessons/{lesson}', [SlessonController::class, 'show'])->name('student.lessons.show');
});

// Grouping routes under 'student/courses/{course}' prefix for Quizzes
Route::prefix('student/courses/{course}')->group(function () {
    Route::get('/quizzes', [SquizController::class, 'index'])->name('student.quizzes.index');
    Route::get('/quizzes/results', [SquizController::class, 'quizResults'])->name('student.quizzes.results');
    Route::get('/quizzes/{quiz}', [SquizController::class, 'show'])->name('student.quizzes.show');
    Route::post('/quizzes/submit', [SquizController::class, 'submitQuiz'])
    ->name('student.quizzes.submit');
    



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



Route::post('/comments/{lesson}', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');




require __DIR__.'/auth.php';
