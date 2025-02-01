<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\Dashboard\QuizController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware(['auth','admin'])->group(function(){
//     Route::resource('admin/users',RegisteredUserController::class);
//     Route::resource('admin/courses',CourseController::class);
//     Route::resource('admin/lessons', LessonController::class);
// });

require __DIR__.'/auth.php';
