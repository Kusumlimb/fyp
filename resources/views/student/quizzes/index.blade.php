@extends('layouts.front.front')

@section('title', 'Quizzes')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg mt-10">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Quizzes for {{ $course->title }}</h1>

    {{-- Success & Error Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Check if the user has already taken the quiz --}}
    @php
        $quizTaken = \App\Models\QuizAttempt::where('user_id', auth()->id())->where('course_id', $course->id)->exists();
    @endphp

    @if(!$quizTaken)
        {{-- Quiz Form --}}
        <div id="quiz-container">
            <form id="quiz-form" action="{{ route('student.quizzes.submit', ['course' => $course->id]) }}" method="POST" class="space-y-6">
                @csrf
                @foreach ($quizzes as $quiz)
                    <div class="quiz-question bg-gray-100 p-4 rounded-lg shadow-md" data-quiz-id="{{ $quiz->id }}">
                        <h2 class="text-xl font-semibold text-gray-700">{{ $quiz->title }}</h2>
                        
                        @foreach ($quiz->options as $option)
                            <label class="flex items-center space-x-3 mt-2">
                                <input type="radio" name="answers[{{ $quiz->id }}]" value="{{ $option->id }}" class="quiz-option w-5 h-5 text-blue-500">
                                <span class="text-gray-700">{{ $option->option_text }}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach

                <div class="flex justify-between mt-6">
                    <button id="submit-button" type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Submit Quiz
                    </button>
                </div>
            </form>
        </div>
    @else
        <p class="text-center text-gray-600">You have already completed this quiz.</p>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("quiz-form");
        const submitButton = document.getElementById("submit-button");
        const quizQuestions = document.querySelectorAll(".quiz-question");

        function checkAllAnswered() {
            let allAnswered = true;
            
            quizQuestions.forEach(question => {
                const quizId = question.getAttribute("data-quiz-id");
                const selectedOption = document.querySelector(`input[name="answers[${quizId}]"]:checked`);
                
                if (!selectedOption) {
                    allAnswered = false;
                }
            });

            submitButton.disabled = !allAnswered;
        }

        form.addEventListener("change", checkAllAnswered);
    });
</script>
@endsection
