@csrf
<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-900">Lesson Name</label>
    <div class="mt-2">
        <input type="text" name="title" id="title"
               value="{{ old('title', $lesson->title) }}"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm"
               placeholder="Enter lesson name" required>
        @error('title')
        <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-900">Lesson Description</label>
    <div class="mt-2">
        <textarea name="description" id="description"
                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm"
                  placeholder="Enter lesson description" required>{{ old('description', $lesson->description) }}</textarea>
        @error('description')
        <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
        @enderror
    </div>
</div>
