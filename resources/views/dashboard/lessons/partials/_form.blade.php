@csrf
        <h2 class="text-base font-semibold text-gray-900">Lesson Information</h2>
        <p class="mt-1 text-sm text-gray-600">Provide details about the lesson you want to create.</p>

        <div class="my-4">
            <label for="title" class="block text-sm/6 font-medium text-gray-900">Lesson Title</label>
            <div class="mt-2">
                <input type="text" name="title" id="title"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6"
                       value="{{ old('title', $lesson->title) }}">
                @error('title')
                <span class="text-xs text-red-600 mt-1">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="course_description" class="block text-sm/6 font-medium text-gray-900">Lesson Description</label>
            <div class="mt-2">
                <textarea type="text"
                          name="description"
                          id="description"
                          placeholder="Write a brief description of the lesson"
                          class="expanded-box block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $lesson->description)}}</textarea>
                @error('description')
                <span class="text-xs text-red-600 mt-1">{{$message}}</span>
                @enderror
            </div>
        </div>

<div class="mb-4">
    <label class="block text-sm/6 font-medium text-gray-900" for="thumbnail">Upload Video</label>
    <div class="mt-2">
        <input type="hidden" value="{{$lesson->video_url}}" name="video_url_old">
        <input class="block w-full px-3 py-1.5 text-base text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none sm:text-sm/6" id="video" name="video" type="file" accept="video/*">
        @error('video')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
        <p class="mt-2 text-sm text-gray-600">Upload a video file for the lesson. Accepted formats: mov, mp4, avi, mkv and flv.</p>
    </div>
    @if($lesson->video_url)
            <div class="w-full mt-2">
                <input name="video_url_old" value="{{$lesson->slug}}" type="hidden">
                <video
                        id="lesson-video-{{$lesson->slug}}"
                        class="video-js"
                        controls
                        height="360px"
                        data-setup='{}'>
                    <source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($lesson->video_url) }}" />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">
                            supports HTML5 video
                        </a>
                    </p>
                </video>
            </div>
    @endif
</div>
@if($lesson->video_url)
@push('scripts')
    <script>

    </script>
@endpush
@endif
