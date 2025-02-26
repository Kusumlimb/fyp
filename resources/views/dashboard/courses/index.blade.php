@extends('layouts.dashboard.dashboard')
@section('title', 'Courses')
@section('content')
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Courses</h1>
        </div>
        @if(auth()->user()->isTeacher())
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('dashboard.courses.create')}}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Course</a>
        </div>
        @endif
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Course Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Course Price</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            @if(auth()->user()->isAdmin())
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Instructor</th>
                            @endif
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created At</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($courses as $course)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <div class="flex items-center gap-x-2">
                                    <span>
                                {{$course->title}}
                                    </span>
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Thumbnail" class="w-10 h-10 rounded-full border-2 border-[#f8b400] shadow-md object-cover object-center">
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Rs {{$course->price / 100}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if(auth()->user()->isAdmin())
                                <div class="mt-2 grid grid-cols-1">
                                    <select data-course="{{$course->slug}}" class="status-update col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @foreach(\App\Enums\Status::cases() as $case)
                                            <option value="{{$case->value}}" {{$course->status === $case ? 'selected' : ''}}>{{$case->label()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                    {{$course->status->label()}}
                                @endif
                            </td>
                            @if(auth()->user()->isAdmin())
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$course->instructor_name}}</td>
                            @endif
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$course->created_at->format('m-d-Y')}}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                <a href="{{route('dashboard.courses.edit', $course->slug)}}" class="rounded-md bg-indigo-50 px-2.5 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100 inline-block">Edit<span class="sr-only">{{$course->title}}</span></a>
                                @if(auth()->user()->isTeacher())
                                <a href="{{route('dashboard.quiz.create', $course->id)}}" class="rounded-md bg-green-50 px-2.5 py-1.5 text-sm font-semibold text-green-600 shadow-sm hover:bg-green-100 inline-block">Add Quiz<span class="sr-only">{{$course->title}}</span></a>
                                @endif
                                <form action="{{ route('dashboard.courses.destroy', $course->slug) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                     @method('DELETE')
                                     @csrf
                                     <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100">Delete</button>
                                 </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">No Course Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                {{$courses->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function (){
            $(document).on('change', '.status-update',function (){
                let that = this;
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Are you sure want to update the status?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: "Continue",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let val = $(that).val();
                        let course = $(that).attr('data-course');
                        let url = "{{route('dashboard.courses.update-status', ':slug')}}";
                        url = url.replace(':slug', course);
                        $.ajax({
                            url: url,
                            type: 'PUT',
                            data: {
                                '_token': "{{csrf_token()}}",
                                'status': val,
                            },
                            beforeSend: function (){
                                document.body.classList.add('loader');
                            },
                            success: function(response) {
                                toastr.success(response.message);
                            },
                            error: function(xhr) {
                                toastr.error(xhr.responseJSON.message);
                            },
                            complete: function (){
                                document.body.classList.remove('loader');
                            }
                        });
                    }
                })

            });
        });
    </script>
@endpush
