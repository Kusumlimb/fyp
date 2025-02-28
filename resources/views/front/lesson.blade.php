@extends('layouts.front.front')
@section('title', $lesson->title)
@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-gray-900 text-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">{{ $lesson->title }}</h1>

             <!-- Video Player -->
            <video controls class="w-full h-[500px] rounded-lg shadow-lg">
                <source src="{{ asset('storage/app/public/videos' . $lesson->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="mt-4">
                <a href="{{ route('front.courses.show', $lesson->course_id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                    Back to Course
                </a>
            </div>
        </div>
    </div>
@endsection
