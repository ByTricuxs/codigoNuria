<?php 
    require '../db.php'; // Incluye el archivo para conectar con la base de datos.
    $configs = $database->select("tb_game_config","*"); // Selecciona todos los registros de la tabla 'tb_game_config' y los almacena en la variable $configs.
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game - config</title>
    <link rel="icon" href="./favicon.ico" />
    <link rel="stylesheet" href="./css/style.css" />
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <!--Fonts-->
</head>
<body>
    <h1>Registered Game - configs</h1> 
    <a href="./add.php">Create New JSON</a>
    <table border="1"> 
        <tr> 
            <th>ID</th> 
            <th>Created At</th> 
            <th>Updated At</th> 
            <th>Actions</th>
        </tr>
        <?php 
            foreach($configs as $config){
                echo "<tr> 
                    <td>GC-{$config['id_game_config']}</td>
                    <td>GC-{$config['created_at']}</td>
                    <td>GC-{$config['updated_at']}</td>
                    <td>
                    <a target='_blank' href='./api.php?id={$config['id_game_config']}'>View</a> 
                        <a href='./edit.php?id={$config['id_game_config']}'>Edit</a>
                        <a href='./delete.php?id={$config['id_game_config']}'>Delete</a> 
                    </td>
                </tr>"; 
            }
        ?>
    </table>
</body>
</html>