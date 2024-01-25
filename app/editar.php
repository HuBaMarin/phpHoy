<?php

require "vendor/autoload.php";

use Dotenv\Dotenv;
use Utilidades_2\DB;

$dotenv = Dotenv::createImmutable(__DIR__ . "./..");
$dotenv->safeLoad();
$clase = new DB();
session_start();
$cod = $_POST['codigo'];

$producto = $clase->obtener_producto($cod);
if ($_POST['Enviar'] === 'Actualizar') {

    $clase->actualizar();
    //header("Location:sitio.php");

}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="editar.php" method="post">
    <?php

    foreach ($producto as $campo=>$valor){
        echo "$campo <input type='text' value='$producto[$campo]' name='$campo'><br />";
        var_dump($producto[$campo]);
    }

    ?>

    <label>
       codigo
        <input type="text" name="codigo" value="<?php echo $cod; ?>"/>
    </label>

    Nuevo nombre corto<input type="text" name="NuevoNombreCorto"> <br>
    Nueva desc <input type="text" name="NuevaDesc"> <br>
    Nuevo PVP <input type="text" name="NuevoPVP"> <br>
    Nuevo Cod <input type="text" name="NuevoCod">
    <input type="submit" value="Actualizar" name="Enviar">



</form>
</body>
</html>

