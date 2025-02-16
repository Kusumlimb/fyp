@extends('layouts.dashboard.dashboard1')

@section('title', 'Lessons')

@section('content')
<div class="container">
    <h1>Lessons for {{ $course->title }}</h1>

    @if($lessons->isEmpty())
        <p>No lessons available.</p>
    @else
        <ul>
            @foreach ($lessons as $lesson)
                <li>
                    <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}">
                        {{ $lesson->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="{{ route('student.courses.show', ['course' => $course->id]) }}">Back to Course</a></p>
</div>
@endsection
