@extends('layouts.dashboard.dashboard1')

@section('title', 'Lesson Details')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">{{ $lesson->title }}</h1>
        
        <video class="w-full rounded-lg shadow-lg" controls>
            <source src="{{ url('storage/videos/' . $lesson->video_path) }}" type="video/mp4">



            Your browser does not support the video tag.
        </video>

        <p class="mt-4 text-gray-600">{{ $lesson->description }}</p>
    </div>
@endsection
