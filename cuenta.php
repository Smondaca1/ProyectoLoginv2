<?php
require 'conexion.php';

$select = new Select(); 

if (isset($_SESSION['id'])) {
    $user = $select->SelectuserByUser($_SESSION['id']);
    if (!$user) {
        
        echo "Usuario no encontrado.";
        
    }
} else {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $user['username']; ?></h1>
    <p>Email: <?php echo $user['email']; ?></p>
    <a href="CerrarSesion.php">Cerrar Sesion</a>
</body>
</html>
