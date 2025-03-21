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
             <ul class="space-y-4 lesson-listing">
                 @foreach ($course->lessons as $lesson)
                     <?php
                      $lessonAlreadyCompleted = in_array($lesson->slug, $completedLessons);
                    ?>
                     <li class="flex  bg-gray-800 rounded-lg relative">
                         <a class="lesson-link flex justify-between p-4 rounded-lg w-full items-center {{$isAlreadyEnrolled || $isCreator ? '' : 'cursor-not-allowed'}}"
                            data-slug="{{ $lesson->slug }}"
                            data-duration="{{$lesson->duration}}"
                            href="{{$isAlreadyEnrolled || $isCreator ? route('front.courses.lessons.view',['course' => $course->slug, 'lesson' => $lesson->slug]) : "javascript:void(0)" }}">
                            <span class="flex items-center gap-2">
                                <div class="progress-container">
                                    <svg width="40" height="40" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="40" stroke="#ddd" stroke-width="10" fill="none"></circle>
                                        <circle cx="50" cy="50" r="40" stroke="#f8b400" stroke-width="10" fill="none"
                                            stroke-dasharray="{{ \Illuminate\Support\Facades\Auth::check() ? 2 * (22/7) * 40 : 0 }}"
                                    
                                            stroke-dashoffset="0"
                                            stroke-linecap="round"
                                            class="progress-circle"
                                            @if(!$lessonAlreadyCompleted)
                                            data-progress="{{ $lesson->slug }}"
                                            @endif>
                                        </circle>
                                        <text x="50" y="55" font-size="20" text-anchor="middle" fill="#fff" @if(!$lessonAlreadyCompleted) class="progress-text" @endif data-text="{{ $lesson->slug }}">{{$lessonAlreadyCompleted ? '100%' : '0%'}}</text>
                                    </svg>
                                </div>
                                <span class="text-white font-medium">{{ ucwords($lesson->title) }}</span>
                             </span>
                            <span class="text-gray-400">{{\Carbon\CarbonInterval::seconds( $lesson->duration)->cascade()->forHumans()}}</span>
                         </a>
                     </li>
                 @endforeach
             </ul>
            <div class="flex space-x-4 justify-center mt-6">
                @guest
                <a href="{{route('login')}}" class="bg-[#f8b400] text-[#0a3d72] px-5 py-2 rounded-lg text-center font-semibold hover:bg-[#f39c12] transition-all duration-300 shadow-lg transform hover:scale-105">Login to Continue</a>
                @else
                    @if(auth()->user()->isStudent())
                        @if($isAlreadyEnrolled)
                            <a href="{{route('front.home')}}" class="bg-green-500  px-5 py-2 rounded-lg text-center font-semibold hover:bg-green-600 transition-all duration-300 shadow-lg transform hover:scale-105">Start Learning</a>
                            <a href="{{ route('student.quizzes.index', ['course' => $course->id]) }}" 
   class="bg-green-500 px-5 py-2 rounded-lg text-center font-semibold hover:bg-green-600 transition-all duration-300 shadow-lg transform hover:scale-105">
   Take quiz
</a>


                        @else
                            <button type="button" class="bg-[#f8b400] text-[#0a3d72] px-5 py-2 rounded-lg text-center font-semibold hover:bg-[#f39c12] transition-all duration-300 shadow-lg transform hover:scale-105" id="khalti-pay-btn">Purchase</button>
                        @endif
                    @endif
                @endif
                <a href="{{ route('front.courses') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg text-center font-semibold hover:bg-gray-600 transition-all duration-300 shadow-lg">Back</a>
            </div>
        </div>
    </div>
@endsection

@auth
@push('scripts')

   <script>
       $(document).ready(function (){
           const COURSE_SLUG = '{{$course->slug}}';
           const CURRENT_USER_ID = '{{auth()->user()->id}}';

           $(document).on('click', '#khalti-pay-btn', function (){
               $.ajax({
                   url: "{{route('payment.initiate', $course->slug)}}",
                   type: 'POST',
                   data: {
                       '_token': "{{csrf_token()}}"
                   },
                   beforeSend: function (){
                       document.body.classList.add('loader');
                   },
                   success: function(response) {
                     window.open(response.payment_url, '_blank');
                   },
                   error: function(xhr) {
                       Swal.fire({
                           title: 'Error!',
                           text: xhr.responseJSON.message,
                           icon: 'error',
                           confirmButtonText: 'Close'
                       })
                   },
                   complete: function (){
                       document.body.classList.remove('loader');
                   }
               });
           });

           function updateLessonProgress() {
               document.querySelectorAll('.lesson-listing a.lesson-link').forEach(lessonLink => {
                   const lessonSlug = lessonLink.dataset.slug;
                   const totalDuration = parseFloat(lessonLink.dataset.duration) || 1;
                   const STORAGE_KEY = `video_progress_${CURRENT_USER_ID}_${COURSE_SLUG}_${lessonSlug}`;
                   const savedTime = parseFloat(localStorage.getItem(STORAGE_KEY)) || 0;

                   const progressPercentage = Math.min((savedTime / totalDuration) * 100, 100);
                   const progressCircle = document.querySelector(`.progress-circle[data-progress="${lessonSlug}"]`);
                   if (progressCircle) {
                       const totalLength = 2 * (22/7) * 40 // Circle circumference
                       progressCircle.style.strokeDashoffset = (totalLength - (totalLength * progressPercentage) / 100).toString();
                   }
                   const progressText = document.querySelector(`.progress-text[data-text="${lessonSlug}"]`);
                   if (progressText) {
                       progressText.textContent = `${Math.round(progressPercentage)}%`;
                   }
               });
           }
           updateLessonProgress();


       })
   </script>
@endpush
@endauth
