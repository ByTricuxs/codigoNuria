
<?php
    $title = ""; 
    $status = false;      
    if($status){           
        $title = "PHP - Laragon";
    }else{
        $title = "JS - Laragon";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - Nuria's Shadows</title>
  <link rel="icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <!-- Fonts -->
</head>
<body>
    
  <div class="signup-page">
    <header class="header">
        <nav class="registerAndLogin">
            <a class ="btnNav" href="./index.html">Home</a>
        </nav>
      </header>
    <img class="logo-login" src="./img/landing/title.png" alt="Logo" />
    <div class="signup-container">
      <form class="signup-form" action="./response.php" method="post">
        <h2>Sign Up</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required />

        <button type="submit" class="btnPage">Sign Up</button>
      </form>
      <div class="signup-footer">
        <p>Already have an account? <a href="./login.php">Log in here</a>.</p>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer-links">
      <a href="index.html">Home</a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
    </div>
    <div class="footer-copyright">
      © 2024 Nuria's Shadows. All rights reserved.
    </div>
  </footer>
</body>
</html>