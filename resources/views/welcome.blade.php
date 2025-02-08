<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language learning platform</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
</head>
<body>
    <header>
    <div class="logo">
    <a href="/">
        <img src="{{\Illuminate\Support\Facades\Vite::asset('resources/images/logo.png')}}" alt="logo" style="height: 50px;">
    </a>
</div>
        <nav>
            <ul>
                <li><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="/about/language">Languages</a></li>
                <li><a href="/about/blog">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div>
            @guest
            <a href="/register" style="margin-right: 15px; color: white;">Register</a>
            <a href="/login" style="color: white;">Log In</a>
            @endguest
            @auth
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <a onclick="event.preventDefault(); this.closest('form').submit()" href="#" style="color: white;">Log Out</a>
                </form>
            @endauth
        </div>
    </header>
    <div class="hero">
        <h1>Learn Your favorite language From Online</h1>
        <button>Browse Languages</button>
    </div>
</body>
</html>

<style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #084f9c;
            color: white;
            text-align: center;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        nav ul {
            display: flex;
            list-style: none;
            padding: 0;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .hero {
            padding: 100px 20px;
            margin-top: 150px;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .hero button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            background-color: #f39c12;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .hero button:hover {
            background-color: #028a3d;
        }
    </style>
