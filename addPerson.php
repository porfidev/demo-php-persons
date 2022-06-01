<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <input type="text" name="birthday"/>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Registrar" />
  </p>
</form>


<?php
//INCLUyE LOS DATOS DE CONEXION
require_once("conexion.php");

$datos = 0;

if(isset($_POST["name"])&& $_POST["insertname"] != "Nombre")
	$datos++;
if(isset($_POST["lastname"])&& $_POST["isertlastname"] != "Apellido paterno")
	$datos++;
if(isset($_POST["mommaidenname"])&& $_POST["insetmommaidenname"] != "Apelido materno")
	$datos++;
if(isset($_POST["birthday"])&& $_POST["insertbirthday"] != "Cumpleaños")
	$datos++;
	
$myquery = mysql_query("SELECT * FROM PERSON ORDER BY IDPERSON");

if($myquery)
	echo "consulta realizada <br>";
else
	die('Consulta no Valida: '.mysql_error());
	
	$duplicado = false;	
	//SI LA CONSULTA ARROJO 1 VALOR O MAS REALIZA LO SIGUENTE
	if(mysql_num_rows($myquery) != 0)
	{
		var_dump($duplicado);
		
		//MIENTRAS HAYA VALORES, SE IMPRIMEN CADA UNO DE ELLOS
		while ($myresult = mysql_fetch_array($myquery))
		{
			$checkrepeated = 0;
			
			echo "".$myresult["IDPERSON"]." - ";
			echo " ".$myresult["NAME"];
			//echo " >>".$_POST["name"];
			
			echo "<hr>";
			var_dump($myresult['NAME']);
			var_dump($_POST["name"]);
			echo "<hr>";
			
			if($myresult['NAME'] == $_POST["name"])
				{
				echo "<b>Nombre IGual </b>";
				$checkrepeated++;
				var_dump($checkrepeated);
				}
			
			echo " ".$myresult["LASTNAME"];
			//echo " >>".$_POST["lastname"];
			
			if($myresult["LASTNAME"] == $_POST["lastname"])
				{
				echo "<b>Apellido IGual </b>";
				$checkrepeated++;
				var_dump($checkrepeated);
				}
				 
			echo " ".$myresult["MOMMAIDENNAME"]."<br>";
			//echo " >>".$_POST["mommaidenname"]."<br>";
			
			if($myresult["MOMMAIDENNAME"] == $_POST["mommaidenname"])
				{	
				echo "<b>Materno Igual </b>";
				$checkrepeated++;
				var_dump($checkrepeated);
				}
				
			echo " ".$myresult["BIRTHDAY"]."<br>";
			//echo " >>".$_POST["mommaidenname"]."<br>";
			
			if($myresult["BIRTHDAY"] == $_POST["birthday"])
				{	
				echo "<b>Materno Igual </b>";
				$checkrepeated++;
				var_dump($checkrepeated);
				}	
			echo "<hr>";
		
			var_dump($duplicado);
			
			if($checkrepeated == 3)
				$duplicado = true;
			
			var_dump($duplicado);
			$nuevoID = $myresult["IDPERSON"];
			
			if($duplicado == true)
				{
				echo "dato duplicado";
				break;
				}
		}
		setType($nuevoID,"integer");
		$nuevoID++;
	}
	
	echo "<br><br><br><br>";
	
	
	if($duplicado == false && $datos == 3)
		{
		$name = $_POST["name"];
		$lastname = $_POST["lastname"];
		$mommaiden = $_POST["mommaidenname"];
		$birthday = $_POST["birthday"];
		echo " datos a insertar $nuevoID - $name $lastname $mommaiden";
		
		$insertquery = mysql_query("INSERT INTO PERSON VALUES($nuevoID,'$name','$lastname','$mommaiden','$birthday','','')");
		
		if($insertquery)
			echo "DATO INGRESADO";
		else
			die('CONSULTA INVALIDADA: '.mysql_error());
		}
?>
</body>
</html>