@extends('layouts.dashboard.dashboard')
@section('title', 'Lessons')
@section('content')
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Lessons</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('dashboard.courses.lessons.create', $course->slug)}}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Lesson</a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                    <div id="lesson-accordion-collapse">
                        @foreach($lessons as $lesson)
                             <div id="{{$lesson->slug}}">
                                  <div id="accordion-header-{{$lesson->id}}" class="flex items-center justify-between w-full p-5 font-medium cursor-pointer rtl:text-right text-gray-500 border border-b-0 border-gray-200 @if($loop->count === 1) rounded-t-xl @endif focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3">
                                      <span>{{ucwords($lesson->title)}}
                                       ({{\Carbon\CarbonInterval::seconds( $lesson->duration)->cascade()->forHumans()}})
                                      </span>
                                      <div class="flex items-center gap-x-2">
                                          <form action="{{ route('dashboard.courses.lessons.destroy', ['course' => $course->slug, 'lesson' => $lesson->slug]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lesson?');">
                                              @method('DELETE')
                                              @csrf
                                              <button type="submit" class="rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100">Delete</button>
                                          </form>
                                          <a href="{{route('dashboard.courses.lessons.edit', ['course' => $course->slug, 'lesson' => $lesson->slug])}}" class="rounded-md bg-indigo-50 px-2.5 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100 inline-block">Edit<span class="sr-only">{{$course->title}}</span></a>
                                          <div  id="lesson-accordion-collapse-heading-{{$lesson->id}}"
                                                data-accordion-target="#lesson-accordion-collapse-body-{{$lesson->id}}"
                                                aria-expanded="false"
                                                data-lesson-id="{{$lesson->id}}"
                                                aria-controls="lesson-accordion-collapse-body-{{$lesson->id}}"
                                          >
                                              <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                              </svg>
                                          </div>
                                      </div>
                                  </div>
                                 <div id="lesson-accordion-collapse-body-{{$lesson->id}}" class="hidden" aria-labelledby="lesson-accordion-collapse-heading-{{$lesson->id}}">
                                     <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                         <p class="mb-2 text-gray-500 dark:text-gray-400">{{$lesson->description}}</p>
                                         <div class="flex justify-center">
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
                                        

                                     </div>
                                 </div>
                             </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        let lessons = @json($lessons);
        let accordionItems = lessons.map(function (element,index){
            return {
                id: `lesson-accordion-collapse-heading-${element.id}`,
                triggerEl: document.querySelector( `#lesson-accordion-collapse-heading-${element.id}`),
                targetEl: document.querySelector( `#lesson-accordion-collapse-body-${element.id}`),
                active: false
            }
        })
        const accordionOptions = {
            activeClasses: 'active',
            inactiveClasses: 'inactive',
            onToggle: ({_items}) => {
                const hasOpenAccordion = _items.some(({ active }) => active);
                $( "#lesson-accordion-collapse" ).sortable(hasOpenAccordion? 'disable' : 'enable');
                let videoElements = document.querySelectorAll("video");
                videoElements.forEach((video) => {
                    if (!video.paused) {
                        video.pause();
                    }
                });

            },
        };
        const accordion = new Accordion(document.getElementById('lesson-accordion-collapse'), accordionItems, accordionOptions);
    </script>
    <script>
        $(document).ready(function (){
            const lessonSortableSelector = $( "#lesson-accordion-collapse");
           lessonSortableSelector.sortable({
                appendTo: document.body,
            });
           lessonSortableSelector.sortable({
                update: function() {
                    $.ajax({
                        url: "{{route('dashboard.courses.lessons.re-order', $course->slug)}}",
                        type: 'get',
                        data: {
                            '_token': "{{csrf_token()}}",
                            'sorted_lessons': lessonSortableSelector.sortable( "toArray")
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON.message)
                        },
                    });
                }
            });



        })
    </script>
    
@endpush
