<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Documento sin título</title>
</head>

<body>
<p>Aqui vamos a agregar un registro</p>
<form id="form1" name="form1" method="POST" action="#">
  <p>Nombre
    <input name="name" type="text"/>
  </p>
  <p>Apellido
    <input name="lastname" type="text"/>
  </p>
  <p>Apellido Materno
    <input name="mommaidenname" type="text"/>
  </p>
  <p>Cumpleaños
    <input type="text" name="birthday" value="1986-04-16"/>
  </p>
  <input type="hidden" name="addNew" value="new"/>
  <p>
    <input type="submit" name="button" id="button" value="Registrar"/>
  </p>
</form>


<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");
$isInsert = false;

if (isset($_POST["addNew"])) {
  $isInsert = true;
}

/** @var mysqli $connection */
$myquery = mysqli_query($connection, "SELECT * FROM Persons ORDER BY id");

if ($myquery)
  echo "consulta realizada <br>";
else
  die('Consulta no Valida: ' . mysqli_error());

$duplicado = false;
//SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
if (mysqli_num_rows($myquery) != 0) {

  //MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS
  while ($myresult = mysqli_fetch_array($myquery)) {
    $checkrepeated = 0;
    echo "" . $myresult["id"] . " - ";
    echo " " . $myresult["name"] . " " . $myresult["lastName"] . " " . $myresult["maidenName"];
    echo " " . $myresult["birthDate"] . "<br>";
  }
}

echo "<br><br><br><br>";


if ($duplicado == false && $isInsert) {
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $mommaiden = $_POST["mommaidenname"];
  $birthday = $_POST["birthday"];
  echo " datos a insertar - $name $lastname $mommaiden";

  $query = <<<'EOF'
    INSERT INTO Persons (name, lastName, maidenName, birthDate)
    VALUES(?,?,?,?)
  EOF;

  $stmt = $connection->prepare($query);
  $stmt->bind_param('ssss', $name, $lastname, $mommaiden, $birthday);
  $result = $stmt->execute();
  $stmt->close();

  if ($result)
    echo "DATO INGRESADO";
  else
    die('CONSULTA INVALIDADA: ' . mysqli_error($connection));
}
?>
</body>
</html>
