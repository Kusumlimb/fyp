<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('dashboard/courses')->middleware(['auth'])->as('dashboard.')->group(function(){
    Route::get('create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    Route::get('{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});


Route::prefix('dashboard/lessons')->middleware(['auth'])->as('dashboard.')->group(function () {
    Route::get('create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('store', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/', [LessonController::class, 'index'])->name('lessons.index');
    // Add edit route to show edit form
    Route::get('{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');

    // Add update route to handle the actual update of the lesson
    Route::put('{lesson}', [LessonController::class, 'update'])->name('lessons.update');

    // Add delete route for lesson deletion
    Route::delete('{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});

// Route::middleware(['auth','admin'])->group(function(){
//     Route::resource('admin/users',RegisteredUserController::class);
//     Route::resource('admin/courses',CourseController::class);
//     Route::resource('admin/lessons', LessonController::class);
// });

require __DIR__.'/auth.php';
