@extends('layouts.front.front')
@section('title', 'Blogs')
@section('styles')

@endsection
@section('content')
    <div class="container mx-auto p-6 flex flex-col md:flex-row">
        <div class="p-6 bg-black bg-opacity-70 text-white flex-1">
            <h2 class="text-3xl font-bold">Contact Us</h2>
            <p class="mt-2 text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="mt-4"><strong>Address:</strong> 4671 Sugar Camp Road, Owatonna, MN 55060</p>
            <p class="mt-2"><strong>Phone:</strong> 561-456-2321</p>
            <p class="mt-2"><strong>Email:</strong> example@email.com</p>
        </div>

        <div class="bg-white p-6  shadow-md text-gray-900 flex-1">
            <h3 class="text-2xl font-semibold">Send Message</h3>
            <form class="mt-4 space-y-4">
                <input type="text" name="name" placeholder="Full Name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500">
                <input type="email" name="email" placeholder="Email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500">
                <textarea name="message" rows="4" placeholder="Type your Message..." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500"></textarea>
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white p-3 rounded-lg transition">Send</button>
            </form>
        </div>
    </div>
@endsection
