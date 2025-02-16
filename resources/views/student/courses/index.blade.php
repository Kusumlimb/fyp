@extends('layouts.dashboard.dashboard1')

@section('title', 'Courses')

@section('content')
<div class="container">
    <h1>Courses</h1>
    <ul>
        @foreach ($courses as $course)
            <li>
                <a href="{{ route('student.courses.show}}">{{ $course->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
