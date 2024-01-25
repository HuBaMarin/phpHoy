<?php
require "vendor/autoload.php";

use Dotenv\Dotenv;
use Utilidades_2\DB;

session_start();
$dotenv = Dotenv::createImmutable(__DIR__ . "./..");
$dotenv->safeLoad();
//desplegable con todos los nombres de las familias
//listado de productos de una familia
$clase = new DB();
$familias = $clase->obtener_familias();
$opt = $_POST['submit'] ?? "";
$productos=[];
$selected_val="";
switch ($opt) {
    case "Mostrar Productos":
        $selected_val = $_POST['familia'];
        $productos = $clase->obtener_productos($selected_val);

        break;
    default:
        break;
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
<form action="sitio.php" method="post">
    <label for="familia">Familia</label>
    <select name="familia" id="familia">
        <?php
        foreach ($familias as $familia) {
            $selected_val==$familia[0]?$selected='selected':$selected='';
            echo '<option value="'.$familia[0].'"'.$selected.' >'.$familia[1].'</option>';
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Mostrar Productos">
</form>
<?php
if (isset($productos)) ?>
<table border="1px solid black">
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
    </tr>

    <?php
    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['PVP'] . "</td>";
        echo "<td>";

        echo '<form action="editar.php" method="post">';

        echo '<input type="hidden" name="codigo" value="'. $producto['codigo']. '">';
        echo '<input type="submit" value="Editar" />';
        echo '</form>';
        echo "</td>";
    }

    ?>


</table>


</body>
</html>
