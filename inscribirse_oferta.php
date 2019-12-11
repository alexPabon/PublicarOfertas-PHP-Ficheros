<?php
session_start();

if($_SESSION["datos"][1]!=0)
	header("location: index.php");

if($_POST)
{
	$oferta = $_POST["oferta"];
	$empresa = $_POST["empresa"];
	$usuario = $_SESSION["datos"][0];

	$candidatos = fopen("files/candidatos.txt", "r");
	$inscribirse = [];
	

	while (!feof($candidatos)){
		$line = trim(fgets($candidatos));
		$datos = explode("|", $line);
		
		if(trim($datos[0])== trim($oferta)){

			array_push($datos, trim($usuario));
			$nw_dato = implode("|", $datos);
			array_push($inscribirse, $nw_dato);

		}else{

			$nw_datos = implode("|", $datos);
			array_push($inscribirse, $nw_datos);
		}
	}
	
	fclose($candidatos);	

	$escribirCandidatos = fopen("files/candidatos.txt", "w");
	$primeraLinea = 0;

	foreach ($inscribirse as $value){
		
		if($primeraLinea==0)
			fputs($escribirCandidatos,trim($value));
		else
			fputs($escribirCandidatos, PHP_EOL.trim($value));					
		
		$primeraLinea++;
	}

	fclose($escribirCandidatos);
	echo "<h2 style='text-align:center;font-size:30px;margin-top:100px;'>Inscrito!</h2>";
	header("refresh:1, ampliada.php?id=".trim($empresa));
}
