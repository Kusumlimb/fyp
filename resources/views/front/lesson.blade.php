@extends('layouts.front.front')
@section('content')
<div class="container mx-auto min-h-[calc(100vh-120px)] flex bg-[#084f9c] p-6 space-x-8">
    <div class="w-1/4 bg-gray-100 p-6 shadow-xl rounded-lg flex flex-col border border-blue-400/20">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Lessons</h2>
        <ul class="space-y-4 flex-1 overflow-y-auto">
            <li class="p-4 bg-white rounded-lg cursor-pointer text-gray-700 hover:bg-blue-100 hover:text-blue-800 transition duration-300 font-medium shadow-sm" onclick="playVideo('video1.mp4')">Lesson 1: Introduction</li>
            <li class="p-4 bg-white rounded-lg cursor-pointer text-gray-700 hover:bg-blue-100 hover:text-blue-800 transition duration-300 font-medium shadow-sm" onclick="playVideo('video2.mp4')">Lesson 2: Basics</li>
            <li class="p-4 bg-white rounded-lg cursor-pointer text-gray-700 hover:bg-blue-100 hover:text-blue-800 transition duration-300 font-medium shadow-sm" onclick="playVideo('video3.mp4')">Lesson 3: Advanced Concepts</li>
        </ul>
    </div>
    <div class="flex-1 flex flex-col items-center bg-gray-100 shadow-xl rounded-lg p-6 border border-blue-400/20">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lesson Video</h2>
        <div class="w-full rounded-lg overflow-hidden shadow-lg border border-gray-200 bg-white">
            <video
                    id="lesson-video-{{$lesson->slug}}"
                    class="video-js vjs-fluid vjs-big-play-centered"
                    controls
                    data-setup='{}'>
                <source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($lesson->video_url) }}" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">
                        supports HTML5 video
                    </a>
                </p>
            </video>
        </div>
    </div>
</div>
@endsection