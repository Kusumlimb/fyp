@extends('layouts.front.front')
@push('styles')
  <style>
      .hero {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          min-height: calc(100vh - 90px);
      }
      .hero h1 {
          font-size: 2.5rem;
          margin-bottom: 20px;
      }
      .hero a{
          padding: 10px 20px;
          font-size: 1rem;
          border: none;
          background-color: #f39c12;
          color: white;
          cursor: pointer;
          border-radius: 5px;
      }
      .hero a:hover {
          background-color: #028a3d;
      }
  </style>
@endpush
@section('content')
     <div class="hero">
         <h1>Learn Your favorite language From Online</h1>
         <a href="{{route('front.courses')}}">Browse Languages</a>
     </div>

     @if(auth()->check() && $recommendedCourses->isNotEmpty())
    <div style="
        position: absolute;
        bottom: 30px;
        right: 30px;
        width: 320px;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 20px;
        border-radius: 15px;
        font-family: 'Segoe UI', sans-serif;
        color: #ffffff;
        z-index: 1000;
    ">
        <h4 style="margin-bottom: 15px; font-size: 18px; font-weight: 600; text-align: center;">
            🌍 Recommended Languages
        </h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach($recommendedCourses as $course)
                <li style="margin-bottom: 10px;">
                    <a href="{{ route('front.courses.course-detail', $course->slug) }}"
                       style="display: block; padding: 10px; background-color: #f39c12; border-radius: 8px; text-decoration: none; color: #ffffff; transition: all 0.2s ease-in-out;"
                       onmouseover="this.style.backgroundColor='#028a3d'"
                       onmouseout="this.style.backgroundColor='#f39c12'">
                        {{ $course->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif




@endsection