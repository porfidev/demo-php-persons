<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Documento sin título</title>
</head>

<body>
<?php

require_once("conexion.php");
/**
 * @var mysqli $connection
 */


if (isset($_GET["deletevalue"])) {
  $delete = mysqli_query($connection, "DELETE FROM Persons WHERE id='" . $_GET["deletevalue"] . "'");
  if (!$delete)
    die('Error al intentar borrar: ' . mysqli_error());

  //EN CASO DE QUE EL BORRADO SEA SATISFACTORIO ENVIA UN MENSAJE
  else
    echo "El registro con el ID <strong>" . $_GET["deletevalue"] . "</strong> se ha eliminado
				<br><hr><br>";

  //AGREGO UN LINK PARA REGRESAR A search.php
  echo "<a href=\"search.php\">Regresar</a>";
}
?>
</body>
</html>
