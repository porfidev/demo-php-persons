<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Documento sin título</title>
</head>

<body>

<?php
//SERVIDOR D ELA BASE DE DATOS
$servidor = "localhost";

//DATOS DEL USUARIO
$usuario = "porfidev";
$contrasena = "X36repentance";

//DATOS DE LA BASE DE DATOS
$basededatos = "persons";

//CONEXION A LA BASE DE DATOS
$connection = mysqli_connect($servidor, $usuario, $contrasena);

if (!$connection)
  die("Error: " . mysqli_error());

mysqli_select_db($connection, $basededatos);
?>

</body>
</html>
