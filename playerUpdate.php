<?php
require './db.php';
header('Content-Type: application/json; charset=utf-8');

session_start();
$current_user_id = $_SESSION['user_id'];

$input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['coins_collected'])) {
        echo json_encode([
            "success" => false,
            "message" => "Datos incompletos: coins_collected es requerido."
        ]);
        exit;
    }
    
$coins_collected = $_POST['coins_collected']; 
$score_increment = $coins_collected * 15;

$current_player = $database->get("tb_players", "player_score", [
    "user_id" => $current_user_id
]);

if ($current_player !== null) {
    $new_score = $current_player + $score_increment;

    $database->update("tb_players", [
        "player_score" => $new_score
    ], [
        "user_id" => $current_user_id
    ]);
    echo json_encode([
        "success" => true,
        "message" => "Puntaje actualizado correctamente.",
        "new_score" => $new_score
    ]);
} else {
    echo "No se encontró al jugador actual en la base de datos.";
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
