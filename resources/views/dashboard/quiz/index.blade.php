@extends('layouts.dashboard.dashboard')
@section('title', 'Quizzes')
@section('content')

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700 shadow-md">
            {{ session('success') }}
        </div>
    @endif
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Quizzes</h1>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Quiz</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Course Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($quizzes as $quiz)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$quiz->title}}</td>
                             <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$quiz->course->title}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                <a href="{{route('dashboard.quiz.edit', $quiz->id)}}" class="rounded-md bg-indigo-50 px-2.5 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100 inline-block">Edit<span class="sr-only">{{$quiz->title}}</span></a>
                                 <form action="{{ route('dashboard.quiz.destroy', $quiz->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                     @method('DELETE')
                                     @csrf
                                     <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100">Delete</button>
                                 </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">No Quiz Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                {{$quizzes->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection
