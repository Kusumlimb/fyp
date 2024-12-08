<?php

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
});

Route::prefix('dashboard/lessons')->middleware(['auth'])->as('dashboard.')->group(function () {
    Route::get('create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('store', [LessonController::class, 'store'])->name('lessons.store');
});

// Route::get('/courses/{courseId}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
// Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');

require __DIR__.'/auth.php';
