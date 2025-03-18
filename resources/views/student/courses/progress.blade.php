@extends('layouts.front.front')
@section('title', 'Progress tracker')
@section('content')
<!-- Progress Tracker Modal -->
<div id="progress-tracker-modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl p-6 overflow-y-auto max-h-[80vh]">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Progress Tracker</h2>
        <table class="w-full text-sm text-left text-gray-700 border">
            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-2">Lesson</th>
                    <th class="px-4 py-2">Lesson Status</th>
                    <th class="px-4 py-2">Quiz</th>
                    <th class="px-4 py-2">Quiz Status</th>
                    <th class="px-4 py-2">Attempts</th>
                </tr>
            </thead>
            <tbody id="progress-tracker-table-body">
                <!-- Filled by JS -->
            </tbody>
        </table>
        <div class="text-right mt-4">
            <button id="close-progress-tracker" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#progress-tracker-btn').click(function () {
            $.ajax({
                url: "{{ route('student.courses.progress', ['course' => $course->id]) }}",
                type: 'GET',
                success: function(response) {
                    let tbody = '';
                    response.forEach(function(item) {
                        tbody += `
                            <tr class="border-t">
                                <td class="px-4 py-2">${item.lesson_title}</td>
                                <td class="px-4 py-2">${item.lesson_status}</td>
                                <td class="px-4 py-2">${item.quiz_title ?? '—'}</td>
                                <td class="px-4 py-2">${item.quiz_status ?? '—'}</td>
                                <td class="px-4 py-2">${item.quiz_attempts ?? '—'}</td>
                            </tr>
                        `;
                    });
                    $('#progress-tracker-table-body').html(tbody);
                    $('#progress-tracker-modal').removeClass('hidden');
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Could not fetch progress data.',
                        icon: 'error'
                    });
                }
            });
        });

        $('#close-progress-tracker').click(function () {
            $('#progress-tracker-modal').addClass('hidden');
        });
    });
</script>
@endpush