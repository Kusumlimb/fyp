@extends('layouts.dashboard.dashboard')
@section('title', 'Create Course')
@section('content')
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
            <div class="px-4 py-4 sm:px-8 border-b border-gray-900/10">
                <div class="-mt-4 -ml-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="mt-4 ml-4">
                        <h3 class="text-base font-semibold text-gray-900">Create Course</h3>
                    </div>
                    <div class="mt-4 ml-4 flex shrink-0">
                        <a href="{{route('dashboard.courses.index')}}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50">
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
            <form class="px-4 py-4 sm:px-8" enctype="multipart/form-data" method="POST" action="{{route('dashboard.courses.store')}}" id="create-course-form">
               @include('dashboard.courses.partials._form')
            </form>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button form="create-course-form" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
@endsection
