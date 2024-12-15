@extends('layouts.dashboard.dashboard')
@section('title', 'Edit Quiz')
@section('content')
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        <div class="px-4 py-4 sm:px-8 border-b border-gray-900/10">
            <div class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="mt-4 ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Create Quiz</h3>
                </div>
                <div class="mt-4 ml-4 flex shrink-0">
                    <a href="{{route('dashboard.courses.index')}}" class="relative inline-flex items-center rounded-md mr-2 bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                        <span>Back</span>
                    </a>
                    <a href="{{route('dashboard.quiz.index')}}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                        <span>All Quizzes</span>
                    </a>
                </div>
            </div>
        </div>
        <form class="px-4 py-4 sm:px-8" enctype="multipart/form-data" method="POST" action="{{route('dashboard.quiz.store', $course)}}" id="create-course-quiz-form">
            @csrf
            <div>
                <div class="flex flex-col space-y-4">
                    <div class="mt-4">
                        <div class="mb-4">
                            <label for="quiz_title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                            <input
                                    value="{{old('quiz_title')}}"
                                    type="text" id="quiz_title"  name="quiz_title" placeholder="Quiz title"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                            @foreach (['quiz_title', 'correct_option'] as $key)
                                @if ($errors->has($key))
                                    <span class="block text-xs text-red-600 mt-1">{{ $errors->first($key) }}</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Options</label>
                            @foreach(range(1, 4) as $index)
                                <div class="mt-2 flex items-center gap-2">
                                    <input
                                            type="radio"
                                            name="correct_option"
                                            value="{{ $index }}"
                                            {{ old('correct_option') == $index ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    >
                                    <input
                                            type="text"
                                            name="options[{{ $index }}][option_text]"
                                            value="{{ old('options.' . $index . '.option_text') }}"
                                            placeholder="Option"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    >
                                </div>
                                @error('options.' . $index . '.option_text')
                                <span class="block text-xs text-red-600 mt-1">{{ $message }}</span>
                                @enderror
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
            <button form="create-course-quiz-form" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
        </div>
    </div>
@endsection

