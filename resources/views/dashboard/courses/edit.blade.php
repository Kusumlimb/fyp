@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Language Course</h1>

    <form enctype="multipart/form-data" method="POST" action="{{ route('dashboard.courses.update', $course->id) }}" class="w-1/2 mx-auto">
        @method('PUT')  <!-- This tells Laravel we're updating an existing resource -->
        @csrf

        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Language Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Modify the details of the language course.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="course-name" class="block text-sm/6 font-medium text-gray-900">Course Name</label>
                        <div class="mt-2">
                            <input type="text" name="course_name" id="course-name" value="{{ old('course_name', $course->course_name) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course name">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="course_description" class="block text-sm/6 font-medium text-gray-900">Language Description</label>
                        <div class="mt-2">
                            <textarea name="course_description" id="course_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Write a brief description of the course">{{ old('course_description', $course->course_description) }}</textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Provide a detailed description of the language course.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('dashboard.courses.index') }}" class="text-sm font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection
