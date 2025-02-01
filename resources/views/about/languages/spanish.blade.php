dd('hit');
@extends('layouts.app')

@section('title', 'Learn Spanish')

@section('content')
    <div class="language-page">
        <h1>Learn Spanish</h1>
        <p>Spanish is one of the most widely spoken languages in the world. Our course will help you learn basic to advanced Spanish in no time!</p>

        <h2>Course Details</h2>
        <ul>
            <li>Spanish Vocabulary</li>
            <li>Grammar and Sentence Structure</li>
            <li>Practice Exercises and Audio Lessons</li>
        </ul>

        <h3>Course Pricing</h3>
        <p><strong>Basic Course:</strong> $99</p>
        <p><strong>Advanced Course:</strong> $199</p>

        <a href="/register" class="btn btn-primary">Register for Spanish Course</a>
    </div>
@endsection

<style>
    .language-page {
        background-color: #fff;
        color: #333;
        padding: 40px;
        margin: 20px auto;
        text-align: center;
        max-width: 800px;
    }
    
    .language-page h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
    }
    
    .language-page h2 {
        font-size: 2em;
        margin-top: 30px;
    }
    
    .language-page ul {
        list-style-type: none;
        padding: 0;
    }

    .language-page ul li {
        font-size: 1.1em;
        margin: 10px 0;
    }

    .language-page h3 {
        font-size: 1.8em;
        margin-top: 30px;
    }

    .language-page p {
        font-size: 1.2em;
        margin: 10px 0;
    }

    .language-page .btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #0a74d3;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .language-page .btn:hover {
        background-color: #084f9c;
    }
</style>
