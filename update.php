<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Documento sin título</title>
</head>

<body>
<?php

//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

//ISSET detemina si una variable esta definida y no es null
if (isset($_GET["newname"])) {
  $consulta = mysql_query("UPDATE PERSON SET NAME=\"" . $_GET["newname"] . "\",LASTNAME=\"" . $_GET["newlastname"] . "\" WHERE IDPERSON =\"" . $_GET["idperson"] . "\"");
  var_dump($consulta);
  if (!$consulta) {
    die('Consulta no Valida: ' . mysql_error());
  } else
    echo "Dato Agregado<br>";
}


?>
<a href="search.php"><< Regresar </a>
</body>
</html>
