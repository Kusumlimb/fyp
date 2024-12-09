<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language learning platform</title>
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Add CSS -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg, #1e3c72, #2a5298);
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
</head>
<body>
    <header>
    <div class="logo">
    <a href="/">
        <img src="/images/logo.png" alt="logo" style="height: 50px;">
    </a>
</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Languages</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div>
            <a href="/register" style="margin-right: 15px; color: white;">Register</a>
            <a href="/login" style="color: white;">Log In</a>
        </div>
    </header>
    <div class="hero">
        <h1>Learn Your favorite language From Online</h1>
        <button>Browse Languages</button>
    </div>
</body>
</html>
