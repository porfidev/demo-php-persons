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
  die("Error: " . mysqli_error($connection));

mysqli_select_db($connection, $basededatos);
