<?php
require "vendor/autoload.php";

use Dotenv\Dotenv;
use Utilidades_2\DB;

$dotenv = Dotenv::createImmutable(__DIR__."./..");
$dotenv->safeLoad();

$conexion = new DB();
$msj="";
$opcion = $_POST['submit'];
switch ($opcion){
    case "Registrarme":
        $usuario= $_POST['usuario'];
        $password= $_POST['password'];
        $msj=$conexion->insertar_usuario($usuario,$password);
        break;
    case "Acceder":
        $usuario= $_POST['usuario'];
        $password= $_POST['password'];
        var_dump($conexion->valida_usuario($usuario,$password));
        if ($conexion->valida_usuario($usuario,$password)){
            session_start();
            $_SESSION['password']=$password;
            header("location:sitio.php");
            exit;
        }else{
            $msj="El usuario no existe";
        }
        break;
    default:

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BD</title>
</head>
<body>
<?php echo $msj?"Inserción correcta":"Error en la inserción de usuario";?>
<fieldset style="width: 50%; background: aqua">
    <legend>Datos de acceso</legend>
    <form action="index.php" method="post">
        usuario <input type="text" name="usuario" id="">
        password <input type="text" name="password" id="">
        submit <input type="submit" name="submit" value="Acceder">
        <input type="submit" name="submit" value="Registrarme">
    </form>
</fieldset>

</body>
</html>
