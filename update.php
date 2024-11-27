<?php
    require 'db.php';
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

    // Reference: https://medoo.in/api/insert
    $database->update("tb_users",[
        "username"=>$_POST["username"],
        "password"=>$pass,
        "email"=>$_POST["email"]
    ]);
?>

<?php
    require 'db.php'; 
    if($_GET){
        $user = $database->select("tb_users","*",["id_user"=> $_GET["id"]]); // Selecciona el usuario.
    }
    if($_POST){
        $database->update("tb_users",[ 
            "username"=>$_POST["name"], 
            "email"=>$_POST["email"]
        ],[
            "id_user"=>$_POST["id"]
        ]);
        header("Location: ./list.php");
    }
?>