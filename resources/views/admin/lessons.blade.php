@extends('layouts.dashboard.dashboard2')

@section('title', 'Lessons Management')

@section('content')
<div class="container mx-auto mt-10 max-w-4xl">
    <h2 class="text-2xl font-semibold mb-4">Lessons Management</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Course</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Created At</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $lesson->id }}</td>
                        <td class="px-6 py-4">{{ $lesson->title }}</td>
                        <td class="px-6 py-4">{{ $lesson->course->title }}</td>
                        <td class="px-6 py-4">{{ $lesson->description }}</td>
                        <td class="px-6 py-4">{{ $lesson->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.deleteLesson', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
