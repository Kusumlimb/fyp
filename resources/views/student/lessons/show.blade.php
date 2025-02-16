@extends('layouts.dashboard.dashboard1')

@section('title', 'Lesson Details')

@section('content')
<div class="container">
    <h1>{{ $lesson->title }}</h1>
    <p>{{ $lesson->description }}</p>

    <h2>Video</h2>
    <iframe width="560" height="315" src="{!! $lesson->video_url !!}" frameborder="0" allowfullscreen></iframe>

    <p><a href="{{ route('student.courses.show', ['course' => $course->id]) }}">Back to Course</a></p>
</div>
@endsection
