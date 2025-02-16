@extends('layouts.dashboard.dashboard1')

@section('title', 'Quiz desc')

@section('content')
<div class="container">
    <h1>{{ $quiz->title }}</h1>

    <h2>Questions</h2>
    <ul>
        @foreach ($quiz->options as $option)
            <li>{{ $option->question }}</li>
        @endforeach
    </ul>

    <p><a href="{{ route('student.courses.show', $quiz->course->id) }}">Back to Course</a></p>
</div>
@endsection
