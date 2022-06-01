<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Documento sin título</title>
</head>

<body>
<form name="formulario_busqueda" method="get" action="search.php">
  <p>Ingresa la persona a buscar:
    <input name="valor_busqueda" type="text"/>
  </p>
  <p>
    <input type="submit" value="Buscar"/>
  </p>
</form>
<!-- SE HACE UN SEGUNDO FORMULARIO PARA SOLICITAR LA INFORMACION DE TODOS
NO INTERVIENE CON EL FORMULARIO ANTERIOR, POR LO QUE SOLO SE PUEDE ENVIAR
UN FORMULARIO A LA VEZ -->
<form name="buscar_todos" method="get" action="search.php">
  <input type="submit" name="buscar_todo" value="Mostrar Todos"/>
</form>
<form name="agregar_registro" method="get" action="addPerson.php">
  <input type="submit" value="Agregar un registro"/>
</form>
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
    die('Consulta no Valida: ' . mysqli_error());
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
if (isset($_GET["buscar_todo"]) && $_GET["buscar_todo"]) {
  $consulta = mysqli_query($connection, "SELECT * FROM Persons");

  //SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
  if (!$consulta) {
    die('Consulta no Valida: ' . mysqli_error());
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
  }
}
?>

</body>
</html>
