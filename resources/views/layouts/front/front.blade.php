<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{asset('js/vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/front.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
@include('layouts.front._partials.header')
@yield('content')
<script src="{{asset('js/vendors/jQuery-3.7.1.js')}}"></script>
<script src="{{asset('js/vendors/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/vendors/sweetalert.js')}}"></script>
<script>
    toastr.options.positionClass =  "toast-bottom-right";
</script>
@if(session()->has('toastr.error'))
    <script>
        toastr.error("{{session('toastr.error')}}")
    </script>
@endif
@stack('scripts')
</body>
</html>