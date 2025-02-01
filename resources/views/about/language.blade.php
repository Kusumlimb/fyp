<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Language Learning Platform</title>
  
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
    
    <h1>Languages you can learn...</h1>
    <div class="language-grid">
      <div class="language-card">
        <img src="https://flagcdn.com/es.svg" alt="Spanish Flag">
        <div class="language-name">Spanish</div>
        <div class="learner-count">53.6M learners</div>
        <a href="{{ route('languages.spanish') }}" class="language-button">Learn Spanish</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/fr.svg" alt="French Flag">
        <div class="language-name">French</div>
        <div class="learner-count">32.2M learners</div>
        <a href="/courses/french" class="language-button">Learn French</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/de.svg" alt="German Flag">
        <div class="language-name">German</div>
        <div class="learner-count">20.5M learners</div>
        <a href="/courses/german" class="language-button">Learn German</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/it.svg" alt="Italian Flag">
        <div class="language-name">Italian</div>
        <div class="learner-count">12.8M learners</div>
        <a href="/courses/italian" class="language-button">Learn Italian</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/br.svg" alt="Portuguese Flag">
        <div class="language-name">Portuguese</div>
        <div class="learner-count">5.66M learners</div>
        <a href="/courses/portuguese" class="language-button">Learn Portuguese</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/nl.svg" alt="Dutch Flag">
        <div class="language-name">Dutch</div>
        <div class="learner-count">1.84M learners</div>
        <a href="/courses/dutch" class="language-button">Learn Dutch</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/ie.svg" alt="Irish Flag">
        <div class="language-name">Irish</div>
        <div class="learner-count">1.55M learners</div>
        <a href="/courses/irish" class="language-button">Learn Irish</a>
      </div>
      <div class="language-card">
        <img src="https://flagcdn.com/dk.svg" alt="Danish Flag">
        <div class="language-name">Danish</div>
        <div class="learner-count">913K learners</div>
        <a href="/courses/danish" class="language-button">Learn Danish</a>
      </div>
    </div>
  </div>
</body>
</html>
<style>
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
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #084f9c;
            color: white;
            text-align: center;
        }

    .container {
      max-width: 900px;
      margin: 50px auto;
      text-align: center;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 20px;
    }

    .language-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .language-card:hover {
      transform: translateY(-5px);
    }
    .language-card {
  background-color: #0a74d3;
  padding: 20px;
  height: 200px; 
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;

  /* Flexbox for centering */
  display: flex;
  flex-direction: column; /* Stack content vertically */
  align-items: center; /* Center horizontally */
  justify-content: center; /* Center vertically */
}

.language-card img {
  width: 50px;
  height: 50px;
  margin-bottom: 10px;
}

.language-card .language-name {
  font-size: 1.2em;
  margin-bottom: 5px;
}

.language-card .learner-count {
  font-size: 0.9em;
}

  </style>