@extends('layouts.dashboard.dashboard1')

@section('title', 'Quizes')

@section('content')
<div class="container">
    <h1>Quizzes for {{ $course->title }}</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('student.quizzes.show', ['course' => $course->id, 'quiz' => $quiz->id]) }}">{{ $quiz->title }}</a>
            </li>
        @endforeach
    </ul>

    <p><a href="{{ route('student.courses.show', $course->id) }}">Back to Course</a></p>
</div>
@endsection
