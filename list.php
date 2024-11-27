<?php 
    require 'db.php';

    $users = $database->select("tb_users","*"); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="icon" href="./favicon.ico" />
</head>
<body>
    <a href="./index.php">Add user</a> 
    <p>Hi <?php echo "<strong>".$_SESSION["username"]."</strong>"; ?></p> 
    <a href="./logout.php">Logout</a> 
    <h1>Registered Users</h1>
    <table border="1">
        <tr>
            <td>Username</td>
            <td>Email</td> 
            <td>Options</td>
        </tr>
        <?php 
            foreach($users as $user){
                echo "<tr>";
                echo "<td>{$user['username']}</td>"; 
                echo "<td>{$user['email']}</td>"; 
                echo "<td><a href='update.php?id={$user['id_users']}'>Update</a> | <a href='delete.php?id={$user['id_users']}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>