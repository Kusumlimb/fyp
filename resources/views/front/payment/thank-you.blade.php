@extends('layouts.front.front')
@push('styles')
    <style>
        .thank-you-box{
            min-height: calc(100vh - 90px);
        }
    </style>
@endpush
@section('content')
    <div class="thank-you-box container flex items-center justify-center pt-4">
        <div class="bg-gradient-to-r from-[#0a3d72] to-[#062c4f] shadow-xl border border-gray-700 rounded-2xl px-10 py-16 text-white text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h1 class="text-3xl font-bold mb-2">Thank You for Your Purchase!</h1>
            <p class="mb-4 text-gray-300">We're excited to have you on board. An email confirmation has been sent to your inbox with the course details.</p>
            <div class="flex justify-center space-x-4">
                <a href="/dashboard" class="bg-[#f8b400] text-[#0a3d72] px-5 py-2 rounded-lg font-semibold hover:bg-[#f39c12] transition-all duration-300 shadow-lg">Go to Dashboard</a>
                <a href="{{ route('front.courses') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-gray-600 transition-all duration-300 shadow-lg">Browse More Courses</a>
            </div>
        </div>
    </div>
@endsection
