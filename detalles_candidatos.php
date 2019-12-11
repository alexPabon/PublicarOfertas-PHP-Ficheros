<?php
	session_start();
	require_once "funciones/funciones.php";
	$infoCandidatos = "";

	if($_SESSION["datos"][1]!=1)
		header("location: index.php");

	//Comprueba si estan inscritos en la oferta
	$candidatos = fopen("files/candidatos.txt", "r");
	$candidatosInscritos = [];
	$oferta = $_GET["id"];

	while(!feof($candidatos)){
		$line = trim(fgets($candidatos));
		$datos = explode("|", $line);
		
		if($datos[0]==$oferta)
			for ($i = 2; $i < count($datos); $i++)
			    array_push($candidatosInscritos, $datos[$i]);
	}

	fclose($candidatos);

	for ($j = 0; $j < count($candidatosInscritos); $j++){

		$curriculum = fopen("files/personas.txt", "r");
		$infoCandidatos.= '<div class="candidatos">';

		    while (!feof($curriculum)){
		    	$line = fgets($curriculum);
				$datos = explode("|", $line);
				
				if($datos[0]==$candidatosInscritos[$j]){

					$id = $datos[0];
					$nombreApell = strtoupper($datos[3])." ".strtoupper($datos[6]);
					$ciudad = $datos[9];
					$experiencia = str_replace("\r", "<br>", json_decode($datos[14]));

					$infoCandidatos.= '<a href="curriculum.php?id='.$id.'"><p class="datosPersonales">'.$nombreApell.'<br><span class="fecha">'.$ciudad.'<br><br>Experiencia:<br></span class="experiencia"><br>'.substr($experiencia,0,150).'....</span></p></a>';
					
			}						
    }
	    $infoCandidatos.= '</div>';

	    fclose($curriculum);		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$_SESSION["user_log"][1] ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/detalles_candidatos.css">	
	</head>
	<body>
		<?php require_once "templates/menu.php"; ?>
		<h1 id="puesto"><?= $_GET["puesto"]; ?></h1>
		<div class="marco_ppal">
			<?= $infoCandidatos	?>
		</div>
	</body>
</html>