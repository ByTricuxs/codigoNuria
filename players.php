
<?php
require './db.php';

$players = $database->select("tb_players", [
    "[>]tb_users" => ["user_id" => "id_users"],
    "[>]tb_tracking" => ["tracking_id" => "id_tracking"]
], [
    "tb_players.id_players",
    "tb_users.username",
    "tb_tracking.score"
], [
    "ORDER" => [
        "tb_tracking.date" => "DESC"
    ]
]);

foreach ($players as $player) {
    if (isset($player['score'])) {
        $database->update("tb_players", [
            "player_score" => $player['score']
        ], [
            "id_players" => $player['id_players']
        ]);
    }
}

$updatedPlayers = $database->select("tb_players", [
    "[>]tb_users" => ["user_id" => "id_users"]
], [
    "tb_players.id_players",
    "tb_users.username",
    "tb_players.player_score"
], [
    "ORDER" => [
        "tb_players.player_score" => "DESC" 
    ]
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <!-- Fonts -->
</head>
<body>
<div class="home tableScores">
        <header class="header">
            <nav class="registerAndLogin">
                <a class="btnNav" href="./index.html">Home</a>
            </nav>
        </header>
        <img class="logo" src="./img/landing/title.png" alt="logo" />
        <h1>Players</h1>
      <div class="players">
        <table class="players-table">
            <tr>
                <th>Player</th>
                <th>Score</th>
            </tr>
            <?php 
                if (!empty($updatedPlayers)) {
                    foreach ($updatedPlayers as $player) {
                        echo "<tr>";
                        echo "<td>" . (isset($player['username']) ? $player['username'] : 'Desconocido') . "</td>";
                        echo "<td>" . (isset($player['player_score']) ? $player['player_score'] : 'Sin puntuación') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay jugadores disponibles.</td></tr>";
                }
            ?>
        </table>
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