@extends('layouts.dashboard.dashboard')
@section('title', 'Edit Quiz')
@section('content')
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        <div class="px-4 py-4 sm:px-8 border-b border-gray-900/10">
            <div class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="mt-4 ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Edit Quiz</h3>
                </div>
                <div class="mt-4 ml-4 flex shrink-0">
                    <a href="{{route('dashboard.quiz.index')}}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>
        <form class="px-4 py-4 sm:px-8" enctype="multipart/form-data" method="POST" action="{{route('dashboard.quiz.update', $quiz->id)}}" id="update-course-quiz-form">
            @method('PUT')
            @csrf
            <div>
                <div class="flex flex-col space-y-4">
                        <div class="mt-4">
                            <div class="mb-4">
                                <label for="quiz_title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                                <input
                                        value="{{old('quiz_title', $quiz->title)}}"
                                        type="text" id="quiz_title"  name="quiz_title" placeholder="Quiz title"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Options</label>
                                @foreach($quiz->options as $option)
                                    <div class="mt-2 flex items-center gap-2">
                                        <input
                                                type="radio"
                                                name="options[{{$loop->index}}][correct]"
                                                {{$option->is_correct ? 'checked': ''}}
                                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                        >
                                        <input
                                                type="hidden"
                                                name="options[{{$loop->index}}][option_id]"
                                                value="{{$option->id}}"
                                        >
                                        <input
                                                type="text"
                                                name="options[{{$loop->index}}][text]"
                                                value="{{old('options_one', $option->option_text)}}"
                                                placeholder="Option"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
            <button form="update-course-quiz-form" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </div>
    </div>
@endsection

