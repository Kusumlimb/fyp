<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/front.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
@include('layouts.front._partials.header')
@yield('content')

@stack('scripts')
</body>
</html>