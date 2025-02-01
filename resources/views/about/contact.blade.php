<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    
</head>
<body>
    <header>
        <div class="logo">
            <a href="/">
                <img src="../images/logo.png" alt="logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about/language">Languages</a></li>
                <li><a href="/about/blog">Blog</a></li>
                <li><a href="/about/contact">Contact</a></li>
            </ul>
        </nav>
        <div class="auth-links">
            <a href="/register">Register</a>
            <a href="/login">Log In</a>
        </div>
    </header>
    
    <div class="contact-container">
        <div class="contact-info">
            <h2>Contact Us</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p><strong>Address:</strong> 4671 Sugar Camp Road, Owatonna, MN 55060</p>
            <p><strong>Phone:</strong> 561-456-2321</p>
            <p><strong>Email:</strong> example@email.com</p>
        </div>
        <div class="contact-form">
            <h3>Send Message</h3>
            <form>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" rows="4" placeholder="Type your Message..." required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</body>
</html>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background:rgb(26, 91, 159);
            color: white;
            text-align: center;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color:#084f9c;
        }
        
        header .logo img {
            height: 50px;
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

        .auth-links a {
            margin-left: 15px;
            color: white;
            text-decoration: none;
        }

        .contact-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            width: 800px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            margin: 100px auto;
            height: 400px;
        }

        .contact-info {
            width: 40%;
        }

        .contact-form {
            width: 55%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            color: black;
        }

        .contact-form button {
            width: 100%;
            background: #00aaff;
            color: white;
            padding: 10px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px; /* Adds space between elements */
        }

        input, textarea {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px; /* Adds more space between input fields */
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input {
            display: block;
        }

        textarea {
            height: 80px;
        }

        button {
            width: 95%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
