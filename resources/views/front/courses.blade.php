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
           width: 80px;
           height: 50px;
           margin-bottom: 10px;
       }
       .language-card:hover {
           transform: translateY(-5px);
       }
       .language-card a{
           background-color: #f39c12;
           color: white;
           border-radius: 5px;
           padding: 5px 10px;
       }
    </style>
@endpush
@section('content')
    <div class="container card-container mt-5">
        <h1 class="heading text-3xl mb-5 font-bold">Languages you can learn...</h1>
        <div class="language-grid">
            @foreach($courses as $course)
                <div class="language-card flex items-center flex-col justify-center text-center">
                    <img src="{{asset("storage/{$course->thumbnail}")}}" class="object-cover max-w-full" alt="{{$course->title}}">
                    <div class="text-xl mb-1">{{$course->title}}</div>
                    <div class="text-md mb-1">{{$course->students_count}} learners</div>
                    <a href="{{ route('front.courses.course-detail', $course->slug) }}" class="text-xs mb-2 text-red-500">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
