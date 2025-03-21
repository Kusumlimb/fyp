@extends('layouts.front.front')
@section('content')
    <div class="container mx-auto min-h-[calc(100vh-120px)] flex bg-[#084f9c] p-6 space-x-8">
        <div class="w-1/4 bg-gray-100 p-6 shadow-xl rounded-lg flex flex-col border border-blue-400/20 lesson-sidebar">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Lessons</h2>
                 <a href="{{route('front.courses.course-detail', $course)}}"
                    class="px-4 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Back</a>
            </div>
            <ul class="space-y-4 flex-1 overflow-y-auto">
                @foreach($course->lessons as $courseLesson)
                    <li class="relative flex items-center">
                        <!-- Circular Progress Bar -->
                        <a class="lesson-link w-full inline-block p-4 rounded-lg cursor-pointer hover:bg-blue-100 {{$courseLesson->slug === $lesson->slug ? 'text-blue-800 bg-blue-100': 'text-gray-700 bg-white'}} hover:text-blue-800 transition duration-300 font-medium shadow-sm"
                           href="{{route('front.courses.lessons.view', ['course' => $course->slug, 'lesson' => $courseLesson->slug])}}"
                        >
                            Lesson {{$loop->iteration}}: {{ucwords($courseLesson->title)}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex-1 bg-gray-100 shadow-xl rounded-lg p-6 border border-blue-400/20">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ucwords($lesson->title)}}</h2>
            <div class="w-full rounded-lg overflow-hidden shadow-lg border border-gray-200 bg-white">
                <video
                        id="lesson-video"
                        class="video-js vjs-big-play-centered"
                        controls
                >
                    <source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($lesson->video_url) }}"/>
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">
                            supports HTML5 video
                        </a>
                    </p>
                </video>
            </div>
            <p class="text-gray-700 mt-3 text-left">
                {!! $lesson->description !!}
            </p>

            {{-- Comment Section --}}
            <div class="mt-8 bg-white p-6 rounded-lg shadow-lg border border-gray-200 min-h-[400px]">

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>

                {{-- Display Comments  --}}
                <div class="mb-6 space-y-4">
                    @forelse($lesson->comments as $comment)
                        <div class="p-4 border border-gray-200 rounded-lg shadow-sm bg-gray-50 min-h-[150px]">

                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                        <span class="font-semibold text-gray-700">
                            {{ $comment->user ? $comment->user->name : 'Deleted User' }}
                        </span>
                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                {{-- Show Edit & Delete options for the comment owner --}}
                                @if(auth()->id() === $comment->user_id)
                                    <div class="flex space-x-2">
                                        {{-- Edit Button --}}
                                        <button onclick="editComment('{{ $comment->id }}')"
                                                class="text-blue-600 hover:underline text-sm">Edit
                                        </button>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm"
                                                    onclick="return confirm('Are you sure?')">Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            {{-- Comment Content --}}
                            <p class="mt-2 text-gray-800"
                               id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>

                            {{-- Edit Comment Form --}}
                            <form id="edit-form-{{ $comment->id }}"
                                  action="{{ route('comments.update', $comment->id) }}" method="POST"
                                  class="hidden mt-3 w-full">

                                @csrf
                                @method('PUT')
                                <textarea name="comment"
                                          class="w-full p-2 border rounded h-24 resize-none bg-white text-black"
                                          required>{{ $comment->content }}</textarea>


                                <button type="submit" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded">Save
                                </button>
                                <button type="button" onclick="cancelEdit('{{ $comment->id }}')"
                                        class="ml-2 px-3 py-1 bg-gray-400 text-white rounded">Cancel
                                </button>

                            </form>

                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>


                @auth
                    <form method="POST" action="{{ route('comments.store', $lesson->id) }}">
                        @csrf
                        <textarea name="comment"
                                  class="w-full p-3 border border-gray-300 rounded-lg text-gray-800 bg-white" rows="4"
                                  placeholder="Write a comment..." required></textarea>
                        <button type="submit"
                                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Comment
                        </button>
                    </form>
                @else
                    <p class="text-gray-600">You must be logged in to comment.</p>
                @endauth
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function editComment(id) {
            document.getElementById(`comment-content-${id}`).classList.add('hidden');
            document.getElementById(`edit-form-${id}`).classList.remove('hidden');
        }

        function cancelEdit(id) {
            document.getElementById(`comment-content-${id}`).classList.remove('hidden');
            document.getElementById(`edit-form-${id}`).classList.add('hidden');
        }
    </script>
@endpush
@push('scripts')
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            const VIDEO_SELECTOR = 'lesson-video';
            const CURRENT_USER_ID = '{{auth()->user()->id}}';
            const COURSE_SLUG = '{{$course->slug}}';
            const LESSON_SLUG = '{{$lesson->slug}}';
            const COMPLETION_ENDPOINT = '{{route("front.courses.mark-complete", ["course" => $course, "lesson" => $lesson])}}';
            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
            const IS_STUDENT = {{auth()->user()->isStudent() ? 'true' : 'false'}};

            const STORAGE_KEY = `video_progress_${CURRENT_USER_ID}_${COURSE_SLUG}_${LESSON_SLUG}`;


            const player = videojs(VIDEO_SELECTOR, {
                autoplay: false,
                fluid: true,
                preload: 'auto',
                playbackRates: [0.5, 0.75, 1, 1.25, 1.5, 2]
            });

            const setupVideoResume = () => {
                const savedTime = localStorage.getItem(STORAGE_KEY);

                if (savedTime && parseFloat(savedTime) > 0) {
                    player.ready(function () {
                        setTimeout(() => {
                            const timeToSeek = parseFloat(savedTime);

                            const duration = player.duration() || 0;
                            if (duration === 0 || timeToSeek < (duration - 10)) {
                                player.currentTime(timeToSeek);

                                player.play().catch(error => {
                                    console.warn('Auto-play prevented by browser:', error);
                                });

                                const notification = document.createElement('div');
                                notification.className = 'vjs-resume-notification';
                                notification.innerHTML = `Resumed from ${Math.floor(timeToSeek / 60)}:${Math.floor(timeToSeek % 60).toString().padStart(2, '0')}`;
                                notification.style.cssText = 'position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.7); color:white; padding:5px 10px; border-radius:4px; z-index:2147483647; opacity:1; transition:opacity 0.5s;';

                                player.el().appendChild(notification);
                                setTimeout(() => {
                                    notification.style.opacity = '0';
                                    setTimeout(() => notification.remove(), 500);
                                }, 3000);
                            }
                        }, 300);
                    });
                }
            };

            const setupProgressTracking = () => {
                player.on("timeupdate", function () {
                    const currentTime = player.currentTime();
                    localStorage.setItem(STORAGE_KEY, currentTime.toString());
                });
            };

            const setupCompletionTracking = () => {
                if (!IS_STUDENT) return;

                player.on("ended", function () {
                   markAsComplete();
                });

                player.on("timeupdate", function () {
                    const currentTime = player.currentTime();
                    const duration = player.duration();

                    if (duration && (currentTime / duration) > 0.95) {
                        player.off("timeupdate");
                        markAsComplete();
                    }
                });
            };

            const  markAsComplete  = async () => {
                return fetch(COMPLETION_ENDPOINT, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        _method: 'PUT'
                    })
                }).catch(err => console.error('Error marking lesson complete:', err));
            }



            setupVideoResume();
            setupProgressTracking();
            @if(auth()->user()->isStudent())
            setupCompletionTracking();
            @endif
        });
    </script>
@endpush
