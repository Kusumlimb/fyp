@extends('layouts.dashboard.dashboard1')

@section('title', 'Lessons')

@section('content')
<div class="container">
  @forelse($courses as $course)
      <h1> {{ $course->title }}</h1>
      <ul>
        @forelse($course->lessons as $lesson)
                <li>
                   <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}">
                        {{ $lesson->title }}
                    </a>
                </li>
      @empty
      <li>No lesson found</li>
      @endforelse
       </ul>

      
  @empty
   <p>No courses
   <p>No courses available.</p>
  @endforelse
</div>
@endsection
