@extends('layouts.dashboard.dashboard')
@section('title', 'Edit Lesson')
@section('content')
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
        <div class="px-4 py-4 sm:px-8 border-b border-gray-900/10">
            <div class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="mt-4 ml-4">
                    <h3 class="text-base font-semibold text-gray-900">Edit Lesson</h3>
                </div>
                <div class="mt-4 ml-4 flex shrink-0">
                    <a href="{{ route('dashboard.lessons.index') }}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>

        <form class="px-4 py-4 sm:px-8" enctype="multipart/form-data" method="POST" action="{{ route('dashboard.lessons.update', $lesson->id) }}" id="update-lesson-form">
            @method('PUT')
            @csrf

            <!-- Error Messages -->
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
                    <h2 class="text-base font-semibold text-gray-900">Lesson Information</h2>
                    <p class="mt-1 text-sm text-gray-600">Update the details of this lesson.</p>

                    <!-- Lesson Title -->
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="title" class="block text-sm font-medium text-gray-900">Lesson Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title"
                                       value="{{ old('title', $lesson->title) }}"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                       placeholder="Enter lesson title" required>
                            </div>
                            @error('title')
                                <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Lesson Description -->
                        <div class="col-span-full">
                            <label for="description" class="block text-sm font-medium text-gray-900">Lesson Description</label>
                            <div class="mt-2">
                                <textarea name="description" id="description" rows="3"
                                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                          placeholder="Write a brief description of the lesson" required>{{ old('description', $lesson->description) }}</textarea>
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Provide a detailed description of this lesson.</p>
                        </div>

                        <!-- Video Upload -->
                        <div class="col-span-full">
                            <label for="video" class="block text-sm font-medium text-gray-900">Video File</label>
                            <div class="mt-2">
                                <input type="file" name="video" id="video"
                                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                       accept="video/*">
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Upload a new video file for this lesson. Accepted formats: mov, mp4, avi, mkv, etc. (Leave empty to keep the current video)</p>
                        </div>

                        <!-- Course Selection -->
                        <div class="col-span-full">
                            <label for="course_id" class="block text-sm font-medium text-gray-900">Course</label>
                            <div class="mt-2">
                                <select name="course_id" id="course_id"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                        required>
                                    <option value="">Select a course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Select the course that this lesson belongs to.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="reset" class="text-sm font-semibold text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
