@extends('layouts.dashboard.dashboard1')

@section('title', 'Course desc')

@section('content')
<div class="container">
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>

    <h2>Lessons</h2>
    <ul>
        @foreach ($course->lessons as $lesson)
            <li>
                <a href="{{ route('student.lessons.show', $lesson->id) }}">{{ $lesson->title }}</a>
            </li>
        @endforeach
    </ul>

    <h2>Quizzes</h2>
    <ul>
        @foreach ($course->quizzes as $quiz)
            <li>
                <a href="{{ route('student.quizzes.show', ['course' => $course->id, 'quiz' => $quiz->id]) }}">{{ $quiz->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
