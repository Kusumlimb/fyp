@extends('layouts.dashboard.dashboard')
@section('title', 'Lessons')
@section('content')

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Lessons</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('dashboard.lessons.create')}}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Lesson</a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Lesson Title</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lesson Description</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Course</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($lessons as $lesson)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $lesson->title }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Str::limit($lesson->description, 30) }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $lesson->course->title ?? 'No Course' }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                <a href="{{ route('dashboard.lessons.edit', $lesson->id) }}" class="rounded-md bg-indigo-50 px-2.5 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100 inline-block">Edit<span class="sr-only">{{ $lesson->title }}</span></a>
                                <form action="{{ route('dashboard.lessons.destroy', $lesson->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lesson?');">
                                     @method('DELETE')
                                     @csrf
                                     <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100">Delete</button>
                                 </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">No Lessons Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{$lessons->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
