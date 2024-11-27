<?php 
    require 'db.php'; 
    $isValid = false; 

    if($_POST){ 
        $user = $database->select("tb_users","*",["username"=> $_POST["username"]]);

        if(count($user) > 0){
            if(password_verify($_POST["password"], $user[0]["password"])){
                session_start();
                $_SESSION["username"] = $user[0]["username"];
                $_SESSION["user_id"] = $user[0]["id_users"];

                $existingPlayer = $database->has("tb_players", ["user_id" => $user[0]["id_users"]]);
            
            if (!$existingPlayer) {
                $database->insert("tb_players", [
                    "user_id" => $user[0]["id_users"],
                    "player_score" => 0 
                ]);
            }
                header("Location: ./menuGame.html"); 
                $isValid = true;
            }else{
                $isValid = false;
            }
        }else{
            $isValid = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Nuria's Shadows</title>
  <link rel="icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <!-- Fonts -->
</head>
<body>
  <div class="login-page">
    <header class="header">
      <nav class="registerAndLogin">
        <a class ="btnNav" href="./index.html">Home</a>
          <a class ="btnNav" href="./index.php">Registrer</a>
      </nav>
    </header>
    <img class="logo-login" src="./img/landing/title.png" alt="logo" />
    <div class="login-container">
      <form class="login-form" action="#" method="POST">
        <h2>Login</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        <button type="submit" class="btnPage">Login</button>
      </form>
      <p class="login-footer">Don't have an account? <a href="./index.php">Sign up here</a>.</p>
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