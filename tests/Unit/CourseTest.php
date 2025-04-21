<?php

use App\Models\Course;
use App\Enums\Status;
use Tests\TestCase;

uses(TestCase::class);

test('a course can be created manually', function () {

    // Manual course creation
    $course = new Course([
        'user_id' => 1, // placeholder
        'title' => 'Intro to Laravel',
        'slug' => 'intro-to-laravel',
        'description' => 'Learn Laravel from scratch',
        'price' => 99.99,
        'status' => Status::ACTIVE,
        'thumbnail' => 'thumbnail.jpg',
    ]);

    expect($course)->toBeInstanceOf(Course::class)
        ->and($course->title)->toBe('Intro to Laravel')
        ->and($course->slug)->toBe('intro-to-laravel')
        ->and($course->description)->toBe('Learn Laravel from scratch')
        ->and($course->price)->toBe(99.99)
        ->and($course->status)->toBe(Status::ACTIVE)
        ->and($course->thumbnail)->toBe('thumbnail.jpg')
        ->and($course->user_id)->toBe(1);
});
