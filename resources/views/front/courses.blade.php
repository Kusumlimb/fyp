@extends('layouts.front.front')
@section('title', 'Courses')
@push('styles')
    <style>
       .language-grid {
           display: grid;
           grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
           gap: 20px;
       }
       .language-card {
           background-color: #0a74d3;
           padding: 20px;
           height: 200px;
           border-radius: 10px;
           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
           transition: transform 0.3s;
       }
       .language-card img {
           width: 50px;
           height: 50px;
           margin-bottom: 10px;
       }
       .language-card .language-name {
           font-size: 1.2em;
           margin-bottom: 5px;
       }
       .language-card .learner-count {
           font-size: 0.9em;
       }
       .language-card:hover {
           transform: translateY(-5px);
       }
    </style>
@endpush
@section('content')
    <div class="container card-container mt-5">
        <h1 class="heading text-3xl mb-5">Languages you can learn...</h1>
        <div class="language-grid">
            @foreach($courses as $course)
                <div class="language-card flex items-center flex-col justify-center text-center">
                    <img src="https://flagcdn.com/es.svg" class="object-cover max-w-full" alt="{{$course->title}}">
                    <div class="language-name">{{$course->title}}</div>
                    <div class="learner-count">{{$course->students_count}} learners</div>
                    <a href="{{ route('languages.spanish') }}" class="language-button">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
