@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-md">
        <h2 class="text-2xl font-bold text-green-600">🎉 Payment Successful!</h2>
        <p class="mt-2 text-gray-700">Thank you for your payment. Your course enrollment has been confirmed.</p>
        
        <a href="{{ route('dashboard.index') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            Go to Dashboard
        </a>
    </div>
</div>
@endsection
