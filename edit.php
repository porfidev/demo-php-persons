<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

//COMPRUEBA SI HAY UN VALOR PARA BUSCAR
if(isset($_GET["editvalue"]))
	{
		//EN CASO DE HABER UN VALOR REALIZA LA SIGUIENTE CONSULTA
		$consulta = mysql_query("SELECT * FROM PERSON WHERE IDPERSON='".$_GET["editvalue"]."'");
		
		//SI LA CONSULTA NO FUNCIONO, ARROJA UN ERROR
		if (!$consulta)
		{
			die('Consulta no Valida: '.mysql_error());
		}
		
		//SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
		if(mysql_num_rows($consulta) != 0)
		{
			//MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS
			while ($resultado = mysql_fetch_array($consulta))
			{
				echo "".$resultado["NAME"];
				echo "".$resultado["LASTNAME"];
				echo "<form name=\"editPerson\" method=\"get\" action=\"update.php\">
  						<p>Nombre: <input name=\"newname\" type=\"text\" value=\"".$resultado["NAME"]."\"/></p>
  						<p>Apellido <input name=\"newlastname\" type=\"text\" value=\"".$resultado["LASTNAME"]."\"/></p>
  						<p>Apellido Materno <input name=\"newmommaidenname\" type=\"text\" value=\"".$resultado["MOMMAIDENNAME"]."\"/></p>
  						<p>Cumpleaños <input type=\"text\" name=\"birthday\"/></p>
						<input type=\"hidden\" name=\"idperson\" value=\"".$resultado["IDPERSON"]."\" />
 						<p><input type=\"submit\" value=\"Actualizar\" /></p>
					 </form>";
			}
		}
		//SI LO ANTERIOR ES IGUAL A 0 (CERO) O QUE NO ARROJA NINGuN VALOR DE LA CONSULTA
		else
		{
			echo "No hay datos relacionados con tu busqueda";
		}
	}	
?>
</body>
</html>