<?php 
    require 'db.php';
    if($_GET){ 
        $user = $database->select("tb_users","*",[ 
            "id_users"=> $_GET["id"]
        ]);
    }

    if($_POST){
        $database->delete("tb_users",[ 
            "id_users"=>$_POST["id"]
        ]);

        header("Location: ./list.php");
    }
?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title>
</head>
<body>
    <h2>Are you sure you want to delete this user?</h2> 
    <h3><?php echo $user[0]["username"]; ?></h3> 

    <form action="./delete.php" method="POST"> 
        <input type="hidden" name="id" value="<?php echo $user[0]["id_users"]; ?>"> 
        <input type="submit" value="Yes"> 
        <input type="button" value="No" onclick="window.history.back()"> 
    </form>
</body>
</html>