@extends('layouts.front.front')

@section('title', 'Quizzes')
@section('content')

    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('student.quizzes.index', ['course' => $course->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Back to Quiz
            </a>
            <h2 class="text-xl font-semibold text-white">Previous Quiz Results</h2>
        </div>

        <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-lg">
            <table class="w-full border border-gray-300 text-gray-800">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border border-gray-300">Attempt</th>
                        <th class="py-2 px-4 border border-gray-300">Score</th>
                        <th class="py-2 px-4 border border-gray-300">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attempts as $index => $attempt)
                        <tr class="border border-gray-300">
                            <td class="py-2 px-4 border border-gray-300 text-center">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border border-gray-300 text-center">{{ $attempt->score }}%</td>
                            <td class="py-2 px-4 border border-gray-300 text-center">{{ $attempt->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
