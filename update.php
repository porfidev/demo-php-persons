<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Basic CRUD with PHP | porfidev</title>
</head>

<body>
<h1>Resultado de actualización</h1>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

/**
 * @var mysqli $connection
 */


//ISSET detemina si una variable esta definida y no es null
if (isset($_GET["name"])) {
  $query = <<<'SQL'
    UPDATE Persons SET name=?,lastName=?,maidenName=?,birthDate=?
    WHERE id=?
    SQL;

  $stmt = $connection->prepare($query);
  $stmt->bind_param('ssssi',
    $_GET['name'],
    $_GET['lastName'],
    $_GET['maidenName'],
    $_GET['birthDate'],
    $_GET['id']);
  $result = $stmt->execute();

  if (!$result) {
    die('Consulta no Valida: ' . mysqli_error($connection));
  } else
    echo "Datos de persona, actualizados.<br /><br />";
}
?>
<a href="index.php"><< Regresar </a>
</body>
</html>
