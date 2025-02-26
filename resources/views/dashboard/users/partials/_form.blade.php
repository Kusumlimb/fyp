@csrf
<div class="mb-4">
    <label for="course_name" class="block text-sm/6 font-medium text-gray-900">Name</label>
    <div class="mt-2">
        <input type="text" name="name" id="name"
               value="{{old('name', $user->name)}}"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter user name">
        @error('name')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="course_description" class="block text-sm/6 font-medium text-gray-900">Email</label>
    <div class="mt-2">
        <input type="email" @if(!$user->id) name="email" @else disabled @endif id="email" class="block w-full rounded-md bg-white px-3 py-1.5 disabled:bg-gray-100 disabled:cursor-not-allowed text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter user email" value="{{old('email', $user->email)}}"/>
        @error('email')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
@if(!$user->id)
<div class="mb-4">
    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
    <div class="mt-2">
        <input type="password" name="password" id="password"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter Password">
        @error('password')
        <span class="text-xs text-red-600 mt-1">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="mb-4">
    <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Password Confirmation</label>
    <div class="mt-2">
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-1 focus:-outline-offset-1 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter Password">
    </div>
</div>
@endif
<div class="mb-4">
    <label for="role" class="block text-sm/6 font-medium text-gray-900">Select Role</label>
    <select  class="mt-2 col-start-1 row-start-1 w-full  disabled:bg-gray-100 disabled:cursor-not-allowed appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  @if(!$user->id) name="role" @else disabled @endif>
        <option value="">Select Role</option>
        @foreach(\App\Enums\Role::cases() as $case)
            @if($case === \App\Enums\Role::ADMIN)
                @continue;
            @endif
            <option value="{{$case->value}}" {{$user->role === $case ? 'selected' : ''}}>{{$case->label()}}</option>
        @endforeach
    </select>
    @error('role')
    <span class="text-xs text-red-600 mt-1">{{$message}}</span>
    @enderror
</div>
