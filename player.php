<?php 
    require './db.php';

    if($_POST){
        // Reference: https://medoo.in/api/insert
        $database->insert("tb_players",[
            "player_name"=>$_POST['name'],
            "player_score"=>$_POST['score']
        ]);

        header("Location: ./players.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./favicon.ico" />
</head>
<body>
    <form action="./player.php" method="post">
        <input type="text" name="name">
        <input type="number" name="score">
        </select>
        <input type="submit">
    </form>
</body>
</html>