@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="space-y-10">
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-900/10">
                <div class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="mt-4 ml-4">
                        <h3 class="text-base font-semibold text-gray-900">Create Course</h3>
                    </div>
                    <div class="mt-4 ml-4 flex shrink-0">
                        <button type="button" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                            <span>Back</span>
                        </button>
                    </div>
                </div>
            </div>
            <form class="px-4 py-5 sm:px-6" enctype="multipart/form-data" method="POST" action="{{route('dashboard.courses.store')}}" id="create-course-form">
                @csrf
                    <div class="mb-4">
                        <label for="course_name" class="block text-sm/6 font-medium text-gray-900">Course Name</label>
                        <div class="mt-2">
                            <input type="text" name="course_name" id="course_name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course name">
                            @error('course_name')
                                <span class="text-xs text-red-600 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Course Description</label>
                        <div class="mt-2">
                            <textarea type="text" name="course_description" id="course_description" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course name"></textarea>
                            @error('course_description')
                                <span class="text-xs text-red-600 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
            </form>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-6">
                <button form="create-course-form" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>

    </div>




    {{-- <div class="container"> --}}
{{--     <h1>Create language course</h1> --}}

{{--     <form  class="w-1/2 mx-auto"> --}}
{{--     @if ($errors->any()) --}}
{{--     <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert"> --}}
{{--         <ul class="list-disc pl-5"> --}}
{{--             @foreach ($errors->all() as $error) --}}
{{--                 <li>{{ $error }}</li> --}}
{{--             @endforeach --}}
{{--         </ul> --}}
{{--     </div> --}}
{{--      @endif --}}

{{--         @csrf --}}
{{--         <div class="space-y-12"> --}}
{{--             <div class="border-b border-gray-900/10 pb-12"> --}}
{{--                 <h2 class="text-base/7 font-semibold text-gray-900">Language Information</h2> --}}
{{--                 <p class="mt-1 text-sm/6 text-gray-600">Provide details about the language course you want to create.</p> --}}

{{--                 <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"> --}}
{{--                     <div class="col-span-full"> --}}
{{--                         <label for="course-name" class="block text-sm/6 font-medium text-gray-900">Course Name</label> --}}
{{--                         <div class="mt-2"> --}}
{{--                             <input type="text" name="course_name" id="course-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course name"> --}}
{{--                         </div> --}}
{{--                     </div> --}}

{{--                     <div class="col-span-full"> --}}
{{--                         <label for="course_description" class="block text-sm/6 font-medium text-gray-900">Language Description</label> --}}
{{--                         <div class="mt-2"> --}}
{{--                             <textarea name="course_description" id="course_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Write a brief description of the course"></textarea> --}}
{{--                         </div> --}}
{{--                         <p class="mt-3 text-sm/6 text-gray-600">Provide a detailed description of the language course.</p> --}}
{{--                     </div> --}}
{{--                 </div> --}}
{{--             </div> --}}

{{--             <div class="mt-6 flex items-center justify-end gap-x-6"> --}}
{{--                 <button type="reset" class="text-sm font-semibold text-gray-900">Cancel</button> --}}
{{--                 <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button> --}}
{{--             </div> --}}
{{--         </div> --}}
{{--     </form> --}}
{{-- </div> --}}
@endsection
