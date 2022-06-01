<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Basic CRUD with PHP | porfidev</title>
</head>

<body>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");
$isInsert = false;

/** @var mysqli $connection */

if ($_POST) {
  $name = $_POST["name"];
  $lastName = $_POST["lastName"];
  $maidenName = $_POST["maidenName"];
  $birthDate = $_POST["birthDate"];

  $query = <<<'EOF'
    INSERT INTO Persons (name, lastName, maidenName, birthDate)
    VALUES(?,?,?,?)
  EOF;

  $stmt = $connection->prepare($query);
  $stmt->bind_param('ssss', $name, $lastName, $maidenName, $birthDate);
  $result = $stmt->execute();
  $stmt->close();

  if ($result) {
    echo "Se ha agregado una nueva persona";
    echo "<br /><a href='index.php'><< Regresar</a>";
  }
  else
    die('CONSULTA INVALIDADA: ' . mysqli_error($connection));

} else {
  $html = <<<HTML
<p>Aqui vamos a agregar un registro</p>
<form id="form1" name="form1" method="POST" action="#">
  <p><label>Nombre
      <input name="name" type="text"/>
    </label>
  </p>
  <p><label>Apellido
      <input name="lastName" type="text"/>
    </label>
  </p>
  <p><label>Apellido Materno
      <input name="maidenName" type="text"/>
    </label>
  </p>
  <p><label>Cumpleaños
      <input type="text" name="birthDate" value="1986-04-16"/>
    </label>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Registrar"/>
  </p>
</form>
HTML;

  echo $html;

}

?>
</body>
</html>
