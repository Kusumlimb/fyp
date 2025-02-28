@extends('layouts.front.front')
@section('title', 'Blogs')
@section('content')
  <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-bold text-gray-900">5 Tips to Learn Spanish Effectively</h2>
      <p class="text-gray-700 mt-2">Spanish is one of the most popular languages in the world. In this post, we’ll share some simple and effective tips to accelerate your Spanish learning journey!</p>
      <a href="#" class="mt-4 inline-block text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition">Read More</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-bold text-gray-900">Top Resources to Master French Pronunciation</h2>
      <p class="text-gray-700 mt-2">Struggling with French pronunciation? Check out these amazing resources that can help you sound like a native speaker in no time.</p>
      <a href="#" class="mt-4 inline-block text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition">Read More</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-bold text-gray-900">How to Practice German Grammar Like a Pro</h2>
      <p class="text-gray-700 mt-2">German grammar can be tricky, but with these techniques, you’ll master it without breaking a sweat. Let’s dive in!</p>
      <a href="#" class="mt-4 inline-block text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition">Read More</a>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-bold text-gray-900">Exploring the Beauty of Italian Culture and Language</h2>
      <p class="text-gray-700 mt-2">Learning Italian is more than just grammar and vocabulary. Discover the fascinating connection between the language and Italian culture.</p>
      <a href="#" class="mt-4 inline-block text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition">Read More</a>
    </div>
  </div>
@endsection