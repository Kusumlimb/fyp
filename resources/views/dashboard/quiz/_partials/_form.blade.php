<div>
    <div class="flex flex-col space-y-4">
        <div class="mt-4">
            <div class="mb-4">
                <label for="quiz_title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                <input
                        value="{{old('quiz_title', $quiz->title)}}"
                        type="text" id="quiz_title"  name="quiz_title" placeholder="Quiz title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                >
                @foreach (['quiz_title', 'correct_option'] as $key)
                    @if ($errors->has($key))
                        <span class="block text-xs text-red-600 mt-1">{{ $errors->first($key) }}</span>
                    @endif
                @endforeach
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Options</label>
                @foreach($quiz->options  as $option)
                    <div class="mt-2 flex items-center gap-2">
                        <input
                                type="radio"
                                name="correct_option"
                                {{$option->is_correct ? 'checked': ''}}
                                value="{{ $option->id }}"
                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        >
                        <input
                                type="hidden"
                                name="options[{{$option->id}}][option_id]"
                                value="{{$option->id}}"
                        >
                        <input
                                type="text"
                                name="options[{{$option->id}}][option_text]"
                                value="{{ old('options.' . $option->id . '.option_text', $option->option_text) }}"
                                placeholder="Option"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        >
                    </div>
                    @error('options.' . $option->id . '.option_text')
                        <span class="block text-xs text-red-600 mt-1">{{ $message }}</span>
                    @enderror
                @endforeach
            </div>
        </div>
    </div>
</div>