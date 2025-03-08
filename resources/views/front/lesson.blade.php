@extends('layouts.front.front')
@section('content')
<div class="container mx-auto min-h-[calc(100vh-120px)] flex bg-[#084f9c] p-6 space-x-8">
    <div class="w-1/4 bg-gray-100 p-6 shadow-xl rounded-lg flex flex-col border border-blue-400/20">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Lessons</h2>
        <ul class="space-y-4 flex-1 overflow-y-auto">
            @foreach($course->lessons as $courseLesson)
                <li>
                    <a class="w-full inline-block p-4  rounded-lg cursor-pointer hover:bg-blue-100 {{$courseLesson->slug === $lesson->slug ? 'text-blue-800 bg-blue-100': 'text-gray-700 bg-white'}} hover:text-blue-800 transition duration-300 font-medium shadow-sm" href="{{route('front.courses.lessons.view', ['course' => $course->slug, 'lesson' => $courseLesson->slug])}}">
                    Lesson {{$loop->count}}: {{ucwords($courseLesson->title)}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="flex-1 bg-gray-100 shadow-xl rounded-lg p-6 border border-blue-400/20">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ucwords($lesson->title)}}</h2>
        <div class="w-full rounded-lg overflow-hidden shadow-lg border border-gray-200 bg-white">
            <video
                    id="lesson-video"
                    class="video-js vjs-big-play-centered"
                    controls
                   >
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
        <p class="text-gray-700 mt-3 text-left">
            {!! $lesson->description !!}
        </p>
    </div>
</div>
@endsection
@push('scripts')
    <script type="module">
        let player = videojs('lesson-video',{
            // autoplay: true,
            fluid: true,
            plugins: {
                hotkeys: {
                    volumeStep: 0.1,
                    seekStep: 5,
                    enableModifiersForNumbers: false,
                },
            },
        });
    </script>
@endpush