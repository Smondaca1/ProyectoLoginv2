<?php

class Conexion
{
    public $host = 'localhost';
    public $usuario = 'root';
    public $contrasena = '';
    public $db = 'datelogin';
    public $conexion;

    public function __construct()
    {
        $this->conexion = mysqli_connect(
            $this->host,
            $this->usuario,
            $this->contrasena,
            $this->db
        );

        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __destruct()
    {
        mysqli_close($this->conexion);
    }
}

class Inicio_sesion extends Conexion
{
    public $id;

    public function InicioSesion($username, $password)
    {
        $username = mysqli_real_escape_string($this->conexion, $username);
        $password = mysqli_real_escape_string($this->conexion, $password);

        $consultaSql = mysqli_query($this->conexion, "SELECT * FROM usuarios WHERE usuario = '$username'");

        if ($consultaSql && mysqli_num_rows($consultaSql) > 0) {
            $columna = mysqli_fetch_assoc($consultaSql);
            if ($password == $columna['password']) {
                $this->id = $columna['id'];
                return 1;
            } else {
                return 10;
            }
        } else {
            return 100;
        }
    }

    public function IdUsuario()
    {
        return $this->id;
    }
}

class Select extends Conexion
{
    public function SelectuserByUser($id)
    {
        $id = mysqli_real_escape_string($this->conexion, $id);
        $resultado = mysqli_query($this->conexion, "SELECT * FROM usuarios WHERE id = '$id'");

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null;
        }
    }
}


class Registrarse extends Conexion
{
    public function registrarse($username,$email,$password,$confirm_password)
    {
        $usuarioExiste = mysqli_query(
            $this -> conexion, "SELECT * FROM usuarios WHERE usuario = '$username' OR email = '$email' "
        );

        if (mysqli_num_rows($usuarioExiste) > 0) {
            return 1;
        }else{
            if ($password == $confirm_password) {
                $consultaSqlRegistro = "INSERT INTO usuarios VALUES ('','$username','$password','$email')";

                mysqli_query($this-> conexion, $consultaSqlRegistro);
                return 10;
            }else{
                return 100;
            }
        }
    }
}
?>

