<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Basic CRUD with PHP | porfidev</title>
</head>

<body>
<h1>Agenda Básica</h1>
<form name="formulario_búsqueda" method="get" action="index.php">
  <p>
    <label>
      Ingresa la persona a buscar:
      <input name="valor_búsqueda" type="text"/>
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
<form action="addPerson.php">
  <input type="submit" value="Agregar persona"/>
</form>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

/**
 * @var mysqli $connection
 */

$elements = '';

//COMPRUEBA SI HAY UN VALOR PARA BUSCAR
if (isset($_GET["valor_búsqueda"]) && $_GET["valor_búsqueda"] != "") {
  //EN CASO DE HABER UN VALOR REALIZA LA SIGUIENTE CONSULTA
  $consulta = mysqli_query($connection, "SELECT * FROM Persons WHERE name LIKE '" . $_GET["valor_búsqueda"] . "%'");

  //SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
  if (!$consulta) {
    die('Consulta no Valida: ' . mysqli_error($connection));
  }


  //SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
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
      <td>$id</td>
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
  } //SI LO ANTERIOR ES IGUAL A 0 (CERO) O QUE NO ARROJA NINGuN VALOR DE LA CONSULTA
  else {
    $elements .= <<<HTML
    <tr>
      <td colspan="7">No hay datos relacionados con tu búsqueda</td>
    </tr>
HTML;
  }
} else {
  //FUNCION QUE SE ACTIVA AL PRESIONAR EL BOTON "MOSTRAR TODOS"
//Comprueba si se envio la variable buscar_todo, si es asi realiza lo siguiente
  $consulta = mysqli_query($connection, "SELECT * FROM Persons order by name");

//SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
  if (!$consulta) {
    die('Consulta no Valida: ' . mysqli_error($connection));
  }

//SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
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
      <td>$id</td>
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
}

$html = <<<HTML
    <table>
      <thead>
       <th></th>
       <th>Nombre</th>
       <th>Apellido paterno</th>
       <th>Apellido Materno</th>
       <th>Fecha de nacimiento</th>
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
