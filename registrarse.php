<?php
session_start();
require 'conexion.php';

if (isset($_SESSION['id'])) {
    header('Location: cuenta.php');
    exit();
}

$register = new Registrarse();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $resultadoRegistro = $register->registrarse($username, $email, $password, $confirm_password);

    if ($resultadoRegistro == 10) {
        echo "<script>alert('Registro exitoso');</script>";
    } elseif ($resultadoRegistro == 1) {
        echo "<script>alert('Registro ya existe');</script>";
    } elseif ($resultadoRegistro == 100) {
        echo "<script>alert('Hubo un fallo, contraseñas no coinciden');</script>";
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
    <title>Registrarse</title>
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
        .btn-success {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-success:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle .toggle-icon {
            position: absolute;
            top: 50px;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-toggle input {
            padding-right: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <i class="fas fa-user-plus"></i>
                        <h2>Registrarse</h2>
                    </div>
                    <div class="card-body">
                        <form action="registrarse.php" method="post">
                            <div class="form-group">
                                <label for="username"><i class="fas fa-user"></i> Usuario:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group password-toggle">
                                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <i class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility('password')"></i>
                            </div>
                            <div class="form-group password-toggle">
                                <label for="confirm_password"><i class="fas fa-lock"></i> Repetir Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                <i class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility('confirm_password')"></i>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" name="submit"><i class="fas fa-user-plus"></i> Registrarse</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php"><i class="fas fa-arrow-left"></i> Volver al Login</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility(id) {
            var passwordField = document.getElementById(id);
            var toggleIcon = passwordField.nextElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
