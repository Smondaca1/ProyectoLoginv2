<?php
session_start();
require 'conexion.php';

// Check if the user is already logged in
if (isset($_SESSION['id'])) {
    header('Location: cuenta.php');
    exit();
}

$iniciosesion = new Inicio_sesion();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $result = $iniciosesion->InicioSesion($username, $password);

    if ($result == 1) {
        $_SESSION['iniciosesion'] = true;
        $_SESSION['id'] = $iniciosesion->IdUsuario();
        echo 'Login successful. Redirecting to cuenta.php';
        header('Location: cuenta.php');
        exit();
    } elseif ($result == 10) {
        echo "<script>alert('Contraseña Incorrecta');</script>";
    } elseif ($result == 100) {
        echo "<script>alert('Usuario no registrado');</script>";
    } else {
        echo "<script>alert('Error desconocido');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2i85hzz13fkacRTHYMtxuI4DvD1gMaRaxvw&s');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            opacity: 0.9;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card-header i {
            font-size: 1.5rem;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <i class="fas fa-user-lock"></i>
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <label for="username"><i class="fas fa-user"></i> Usuario:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="registrarse.php"><i class="fas fa-user-plus"></i> Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

