@extends('layouts.front.front')
@section('title', 'Courses')
@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-gradient-to-r from-[#0a3d72] to-[#062c4f] shadow-xl border border-gray-700 rounded-2xl p-6 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between mb-4">
                <h1 class="text-2xl font-bold mb-2 md:mb-0">
                    Learn {{ ucwords($course->title) }}
                    <span class="text-[#f8b400] font-medium text-lg">by {{ $course->instructor->name }}</span>
                </h1>
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Thumbnail" class="w-16 h-16 rounded-full border-2 border-[#f8b400] shadow-md object-cover object-center">
                </div>
            </div>

            <h2 class="text-lg font-semibold mb-2">Course Details</h2>
            <p class="mb-3 text-gray-300">{!! $course->description !!}</p>

            <h3 class="text-md font-semibold mb-2">Course Pricing</h3>
            <p class="mb-3 text-gray-300"><strong>Lifetime: </strong> Rs {{ $course->price / 100 }}</p>

            <h3 class="text-md font-semibold mb-2">Enrolled Students</h3>
            <p class="mb-5 text-gray-300">👨‍🎓 {{ $course->students_count }} students enrolled</p>

            <h3 class="text-lg font-semibold mb-2">Course Content</h3>
             <ul class="space-y-4">
                 @foreach ($course->lessons as $lesson)
                     <li class="flex justify-between items-center bg-gray-800 p-4 rounded-lg">
                         <span class="text-white font-medium">{{ $lesson->title }}</span>
                         <span class="text-gray-400">{{ $lesson->duration }} minutes</span>
                     </li>
                 @endforeach
             </ul>
            <div class="flex space-x-4 justify-center mt-6">
                @guest
                <a href="{{route('login')}}" class="bg-[#f8b400] text-[#0a3d72] px-5 py-2 rounded-lg text-center font-semibold hover:bg-[#f39c12] transition-all duration-300 shadow-lg transform hover:scale-105">Login to Continue</a>
                @else
                <button type="button" class="bg-[#f8b400] text-[#0a3d72] px-5 py-2 rounded-lg text-center font-semibold hover:bg-[#f39c12] transition-all duration-300 shadow-lg transform hover:scale-105" id="khalti-pay-btn">Purchase</button>
                @endif
                <a href="{{ route('front.courses') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg text-center font-semibold hover:bg-gray-600 transition-all duration-300 shadow-lg">Back</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
   <script>
       $(document).ready(function (){
           $(document).on('click', '#khalti-pay-btn', function (){
               $.ajax({
                   url: "{{route('payment.initiate', $course->slug)}}",
                   type: 'POST',
                   data: {
                       '_token': "{{csrf_token()}}"
                   },
                   beforeSend: function (){

                   },
                   success: function(response) {
                     window.open(response.payment_url, '_blank');
                   },
                   error: function(xhr) {
                       Swal.fire({
                           title: 'Error!',
                           text: xhr.message,
                           icon: 'error',
                           confirmButtonText: 'Close'
                       })
                   },
                   complete: function (){

                   }
               });
           });

       })
   </script>
@endpush

