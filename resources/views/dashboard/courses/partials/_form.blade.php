@csrf
<div class="mb-4">
    <label for="course_name" class="block text-sm/6 font-medium text-gray-900">Course Name</label>
    <div class="mt-2">
        <input type="text" name="course_name" id="course_name"
               value="{{old('course_name', $course->title)}}"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course name">
        @error('course_name')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="course_description" class="block text-sm/6 font-medium text-gray-900">Course Description</label>
    <div class="mt-2">
        <textarea type="text" name="course_description" id="course_description" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course description">{{old('course_description', $course->description)}}</textarea>
        @error('course_description')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="course_price" class="block text-sm/6 font-medium text-gray-900">Course Price</label>
    <div class="mt-2">
        <input type="text" name="course_price" id="course_price"
               value="{{old('course_price', $course->price / 100)}}"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter course price">
        @error('course_price')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
<div>
    <label class="block text-sm/6 font-medium text-gray-900" for="thumbnail">Upload file</label>
    <div class="mt-2">
        <input type="hidden" value="{{$course->thumbnail}}" name="thumbnail_old">
        <input class="block w-full px-3 py-1.5 text-base text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none sm:text-sm/6" id="thumbnail" name="thumbnail" type="file" accept="image/*">
        @error('thumbnail')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
    <div class="mt-2">
    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Thumbnail" class="w-16 h-16 rounded-full border-2 border-[#f8b400] shadow-md object-cover object-center">
    </div>
</div>