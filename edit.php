<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Basic CRUD with PHP | porfidev</title>
</head>

<body>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

/**
 * @var mysqli $connection
 */


//COMPRUEBA SI HAY UN VALOR PARA BUSCAR
if (isset($_GET["editvalue"])) {
  //EN CASO DE HABER UN VALOR REALIZA LA SIGUIENTE CONSULTA
  $consulta = mysqli_query($connection,"SELECT * FROM Persons WHERE id='" . $_GET["editvalue"] . "'");

  //SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
  if (!$consulta) {
    die('Consulta no Valida: ' . mysqli_error($connection));
  }

  //SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
  if (mysqli_num_rows($consulta) != 0) {
    //MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS
    while ($resultado = mysqli_fetch_array($consulta)) {
      echo "<form name=\"editPerson\" method=\"get\" action=\"update.php\">
  						<p>Nombre: <input name=\"name\" type=\"text\" value=\"" . $resultado["name"] . "\"/></p>
  						<p>Apellido <input name=\"lastName\" type=\"text\" value=\"" . $resultado["lastName"] . "\"/></p>
  						<p>Apellido Materno <input name=\"maidenName\" type=\"text\" value=\"" . $resultado["maidenName"] . "\"/></p>
  						<p>Cumpleaños <input type=\"text\" name=\"birthDate\" value=\"" . $resultado["birthDate"] . "\" /></p>
						<input type=\"hidden\" name=\"id\" value=\"" . $resultado["id"] . "\" />
 						<p><input type=\"submit\" value=\"Actualizar\" /></p>
					 </form>";
    }
  } //SI LO ANTERIOR ES IGUAL A 0 (CERO) O QUE NO ARROJA NINGuN VALOR DE LA CONSULTA
  else {
    echo "No hay datos relacionados con tu busqueda";
  }
}
?>
</body>
</html>
