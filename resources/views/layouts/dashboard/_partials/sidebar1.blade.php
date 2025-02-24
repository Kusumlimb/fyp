<?php
$activeMenu = $activeMenu ?? '';
?>

<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <img class="h-full w-auto" src="{{ Vite::asset('resources/images/logo.png') }}" alt="Your Company">
    </div>

    <nav class="flex flex-1 flex-col" x-data="{ openSection: null, openCourse: null }">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard.index') }}"
                           @class([
                               'group flex gap-x-3 rounded-md p-2 text-sm font-semibold text-gray-400 hover:text-white hover:bg-gray-800',
                               'bg-gray-800 text-white' => $activeMenu === 'dashboard'
                           ])>
                            <svg class="size-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Student Dashboard
                        </a>
                    </li>

                    <!-- Courses Section -->
                    <li>
                        <button @click="openSection = openSection === 'courses' ? null : 'courses'"
                                class="group flex justify-between items-center w-full rounded-md p-2 text-sm font-semibold text-gray-400 hover:text-white hover:bg-gray-800">
                            <div class="flex items-center gap-x-3">
                                <svg class="size-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
                                </svg>
                                Courses
                            </div>
                            <svg class="size-4 transition-transform" :class="openSection === 'courses' ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- Courses List-->
                        <div x-show="openSection === 'courses'" x-collapse class="pl-6 mt-2 space-y-2">
                            @foreach($courses as $course)
                                <div>
                                    <!-- Course Item -->
                                    <button @click="openCourse = (openCourse === {{ $course->id }} ? null : {{ $course->id }})"
                                            class="group flex justify-between items-center w-full rounded-md p-2 text-sm font-semibold text-gray-400 hover:text-white hover:bg-gray-800">
                                        <div class="flex items-center gap-x-3">
                                            <svg class="size-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                            </svg>
                                            {{ $course->title }}
                                        </div>
                                        <svg class="size-4 transition-transform" :class="openCourse === {{ $course->id }} ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <!-- Nested Lessons -->
                                    <div x-show="openCourse === {{ $course->id }}" x-collapse class="pl-8 mt-2 space-y-2">
                                        @foreach($course->lessons as $lesson)
                                            <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
                                               class="block text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-md p-2">
                                                {{ $lesson->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
