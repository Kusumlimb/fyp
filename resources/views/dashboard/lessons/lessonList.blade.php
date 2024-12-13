@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lessons</h1>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Lesson Title</th>
                <th class="border border-gray-300 px-4 py-2">Lesson Description</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $lesson->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $lesson->description }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <!-- Edit Button -->
                    <a href="{{ route('dashboard.lessons.edit', $lesson->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('dashboard.lessons.destroy', $lesson->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lesson?');">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
