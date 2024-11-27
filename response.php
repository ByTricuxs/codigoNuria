<?php
    require 'db.php';
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

    // Reference: https://medoo.in/api/insert
    $database->insert("tb_users",[
        "username"=>$_POST["username"],
        "password"=>$pass,
        "email"=>$_POST["email"]
    ]);

    header("Location: login.php");
    exit();
?>