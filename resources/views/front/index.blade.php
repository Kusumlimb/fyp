@extends('layouts.front.front')
@push('styles')
  <style>
      .hero {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          height: calc(100vh - 90px);
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
@endsection