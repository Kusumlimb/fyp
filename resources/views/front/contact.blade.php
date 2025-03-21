@extends('layouts.front.front')
@section('title', 'Blogs')
@section('styles')

@endsection
@section('content')
    <div class="container mx-auto p-6 flex flex-col md:flex-row">
        <div class="p-6 bg-black bg-opacity-70 text-white flex-1">
            <h2 class="text-3xl font-bold">Contact Us</h2>
            <p class="mt-2 text-gray-300">Hello this is the contact page of 'The language learning platform'. 
                Please feel free to ask us anything.</p>
            <p class="mt-4"><strong>Address:</strong> Pathari Shanischare-2, Morang</p>
            <p class="mt-2"><strong>Phone:</strong> 561-456-2321</p>
            <p class="mt-2"><strong>Email:</strong> Kusumlimbu75@gmail.com</p>
        </div>

        <div class="bg-white p-6  shadow-md text-gray-900 flex-1">
            <h3 class="text-2xl font-semibold">Send Message</h3>
            @if (session('status'))
    <div class="p-3 bg-green-100 text-green-800 rounded">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('contact.send') }}" class="mt-4 space-y-4">
    @csrf
    <input type="text" name="name" placeholder="Full Name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500">
    
    <input type="email" name="email" placeholder="Email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500">
    
    <textarea name="message" rows="4" placeholder="Type your Message..." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500"></textarea>
    
    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white p-3 rounded-lg transition">Send</button>
</form>

        </div>
    </div>
@endsection
