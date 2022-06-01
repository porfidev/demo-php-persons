<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Basic CRUD with PHP | porfidev</title>
</head>

<body>
<form name="formulario_busqueda" method="get" action="index.php">
  <p>
    <label>
      Ingresa la persona a buscar:
      <input name="valor_busqueda" type="text"/>
    </label>
    <input type="submit" value="Buscar"/>
  </p>
</form>
<!-- SE HACE UN SEGUNDO FORMULARIO PARA SOLICITAR LA INFORMACION DE TODOS
NO INTERVIENE CON EL FORMULARIO ANTERIOR, POR LO QUE SOLO SE PUEDE ENVIAR
UN FORMULARIO A LA VEZ -->
<form name="buscar_todos" method="get" action="index.php">
  <input type="submit" name="buscar_todo" value="Mostrar Todos"/>
</form>
<a href="addPerson.php">Agregar persona</a>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

/**
 * @var mysqli $connection
 */

//COMPRUEBA SI HAY UN VALOR PARA BUSCAR
if (isset($_GET["valor_busqueda"]) && $_GET["valor_busqueda"] != "") {
  //EN CASO DE HABER UN VALOR REALIZA LA SIGUIENTE CONSULTA
  $consulta = mysqli_query($connection, "SELECT * FROM Persons WHERE name LIKE '" . $_GET["valor_busqueda"] . "%'");

  //SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
  if (!$consulta) {
    die('Consulta no Valida: ' . mysqli_error($connection));
  }

  //SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
  if (mysqli_num_rows($consulta) != 0) {
    //MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS
    while ($resultado = mysqli_fetch_array($consulta)) {
      $idperson = $resultado["id"];
      echo "" . $resultado["name"];
      echo "" . $resultado["lastName"];
      echo "<form name=\"edit_$idperson\" method=\"get\" action=\"edit.php\">
						<input type=\"hidden\" name=\"editvalue\" value=\"$idperson\" />
						<input type=\"submit\" value=\"editar\">
					  </form>";
      echo "<form name=\"delete_$idperson\" method=\"get\" action=\"delete.php\">
						<input type=\"hidden\" name=\"deletevalue\" value=\"$idperson\" />
						<input type=\"submit\" value=\"eliminar\"><br />
					</form>";
    }
  } //SI LO ANTERIOR ES IGUAL A 0 (CERO) O QUE NO ARROJA NINGuN VALOR DE LA CONSULTA
  else {
    echo "No hay datos relacionados con tu busqueda";
  }

}

//FUNCION QUE SE ACTIVA AL PRESIONAR EL BOTON "MOSTRAR TODOS"
//Comprueba si se envio la variable buscar_todo, si es asi realiza lo siguiente
$consulta = mysqli_query($connection, "SELECT * FROM Persons order by name");

//SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
if (!$consulta) {
  die('Consulta no Valida: ' . mysqli_error($connection));
}

//SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
$elements = '';

if (mysqli_num_rows($consulta) != 0) {
  //MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS

  while ($resultado = mysqli_fetch_array($consulta)) {
    $id = $resultado["id"];
    $name = $resultado["name"];
    $lastName = $resultado["lastName"];
    $maidenName = $resultado["maidenName"];
    $birthDate = $resultado["birthDate"];

    $elements .= <<<HTML
    <tr>
      <td>$name</td>
      <td>$lastName</td>
      <td>$maidenName</td>
      <td>$birthDate</td>
      <td>
      <form name="edit_$id" method="get" action="edit.php">
                  <input type="hidden" name="editvalue" value="$id" />
                  <input type="submit" value="editar">
                  </form>
      </td>
      <td>
      <form name="delete_$id" method="get" action="delete.php">
                  <input type="hidden" name="deletevalue" value="$id" />
                  <input type="submit" value="eliminar"><br />
                </form>
      </td>
    </tr>
HTML;
  }
} else {
  $elements .= <<<HTML
    <tr>
      <td colspan="7">No hay personas registradas</td>
    </tr>
HTML;
}

$html = <<<HTML
    <table>
      <thead>
       <th>Nombre</th>
       <th>Apellido paterno</th><th>Apellido Materno</th><th>Fecha de nacimiento</th>
       <th></th>
      </thead>
      <tbody>
        $elements
      </tbody>
    </table>
    HTML;
echo $html;
?>

</body>
</html>
