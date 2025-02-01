<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <style>
    /* Header Styles */
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

    /* Body Styles */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: rgb(26, 91, 159);
      color: white;
      text-align: center;
    }

    /* Blog Container */
    .container {
      max-width: 1000px;
      margin: 2rem auto;
      padding: 0 1rem;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    /* Blog Post Box */
    .blog-post {
      width: 250px; /* Fixed width */
      height: 250px; /* Fixed height to make it square */
      background: white;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }

    .blog-post:hover {
      transform: translateY(-5px);
    }

    .blog-post h2 {
      font-size: 1.2rem;
      color: #084f9c;
      margin-bottom: 10px;
    }

    .blog-post p {
      font-size: 0.9rem;
      flex-grow: 1;
    }

    .blog-post a {
      display: inline-block;
      color: white;
      background: #084f9c;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      text-decoration: none;
    }

    .blog-post a:hover {
      background: #063e7a;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <a href="/">
      <img src="../images/logo.png" alt="logo" style="height: 50px;">
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
  <div>
    <a href="/register" style="margin-right: 15px; color: white;">Register</a>
    <a href="/login" style="color: white;">Log In</a>
  </div>
</header>

<div class="container">
  <div class="blog-post">
    <h2>5 Tips to Learn Spanish Effectively</h2>
    <p>Spanish is one of the most popular languages in the world. In this post, we’ll share some simple and effective tips to accelerate your Spanish learning journey!</p>
    <a href="#">Read More</a>
  </div>

  <div class="blog-post">
    <h2>Top Resources to Master French Pronunciation</h2>
    <p>Struggling with French pronunciation? Check out these amazing resources that can help you sound like a native speaker in no time.</p>
    <a href="#">Read More</a>
  </div>

  <div class="blog-post">
    <h2>How to Practice German Grammar Like a Pro</h2>
    <p>German grammar can be tricky, but with these techniques, you’ll master it without breaking a sweat. Let’s dive in!</p>
    <a href="#">Read More</a>
  </div>

  <div class="blog-post">
    <h2>Exploring the Beauty of Italian Culture and Language</h2>
    <p>Learning Italian is more than just grammar and vocabulary. Discover the fascinating connection between the language and Italian culture.</p>
    <a href="#">Read More</a>
  </div>
</div>

</body>
</html>
