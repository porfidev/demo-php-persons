<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
//SERVIDOR D ELA BASE DE DATOS
$servidor="localhost";

//DATOS DEL USUARIO
$usuario="elporfirio";
$contrasena="X24nany";

//DATOS DE LA BASE DE DATOS
$basededatos="u170891_TEST";

//CONEXION A LA BASE DE DATOS

$conectarse = mysql_connect($servidor,$usuario,$contrasena);

if (!$conectarse) 
	die("Error: " .mysql_error());
else
	echo "Me he conectado a la base de datos";
	

mysql_select_db($basededatos, $conectarse);
?>

</body>
</html>
