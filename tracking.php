
<?php 
require './db.php';

session_start();

date_default_timezone_set('America/Costa_Rica');

if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);
    error_log(print_r($data, true));

    $database->insert("tb_tracking", [
        "length" => $data['length'],
        "device_type" => $data['browser'],
        "screen_size" => $data['screen'],
        "level" => $data['level'],
        "has_closed_browser" => $data['closed'],
        "date" => date('Y-m-d H:i:s'),
        "score" => $data['score'],
        "user_id" => $_SESSION["user_id"]
    ]);

    $existingPlayer = $database->has("tb_players", ["user_id" => $_SESSION["user_id"]]);
    if ($existingPlayer) {
        $database->update("tb_players", [
            "player_score" => $data['score']
        ], [
            "user_id" => $_SESSION["user_id"]
        ]);
    } else {
        $database->insert("tb_players", [
            "user_id" => $_SESSION["user_id"],
            "player_score" => 0
        ]);
    }

    $message = "Tracking data saved and player score updated.";
    echo json_encode($message);
}
echo json_encode($message, JSON_PRETTY_PRINT);
?>

