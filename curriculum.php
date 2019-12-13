<?php
	session_start();

	if($_SESSION["datos"][1]!=1)
		header("location: index.php");
	
	$persona = $_GET["id"];
	$usuarios = fopen("files/personas.txt", "r");
	$informacionUsuario = [];

	while (!feof($usuarios)){
		$line = trim(fgets($usuarios));
		$datos = explode("|", $line);

		if($datos[0]==$persona){
			$informacionUsuario = $datos;
			break;
		}
	}
	
	$imagenP = $informacionUsuario[2];
	$nombreApell = $informacionUsuario[3]." ".$informacionUsuario[6];
	$documento = $informacionUsuario[7];
	$direccion = $informacionUsuario[8];
	$ciudad = $informacionUsuario[9];
	$tel = $informacionUsuario[10];
	$correo = $informacionUsuario[11];
	$fchNacimiento = $informacionUsuario[12];
	$estado = $informacionUsuario[13];
	$experiencia = str_replace("\r", "<br>", json_decode($informacionUsuario[14]));
	$idiomas = str_replace("\r", "<br>", json_decode($informacionUsuario[15]));
	$aficiones = str_replace("\r", "<br>", json_decode($informacionUsuario[16]));
	$enlaces = str_replace("\r", "<br>", json_decode($informacionUsuario[17]));
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $nombreApell; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/curriculum.css">
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<div id="marco_gral">
		<div class="cabecera">
			<h1>Curriculum Vitae</h1>
			<h3><?= strtoupper($nombreApell); ?></h3>
		</div>
		<div class="marco">
			<div id="datos" class="pos_left">				
				
				<div id="foto" style="background-image: url(<?= $imagenP; ?>);"></div>
				<p id="datosPers" class="informacion">
					Email: <a href="mailto:<?php echo $correo; ?>"><?= $correo."<br>"; ?></a>
					<?php						
						echo "Tel: ".$tel."<br>";
						echo "DNI: ".$documento."<br>";
						echo "Estado civil: ".$estado."<br><br>";
						echo "Direccion: ".$direccion."<br>";
						echo "Ciudad: ".$ciudad;
					?>					
				</p>
				<div class="marcoInfo">
					<h4>Aficiones</h4>
					<p><?= $aficiones; ?></p>
				</div>
			</div>
			<div id="datos1" class="pos_right">
				<div class="marcoInfo">
					<h4>Eperiencia</h4>
					<p><?= $experiencia; ?></p>
				</div>
				<div class="marcoInfo">
					<h4>Idiomas</h4>
					<p><?= $idiomas; ?></p>
				</div>
				<div class="marcoInfo">
					<h4>Mis Enlaces</h4>
					<p><?= $enlaces; ?></p>
				</div>
			</div>	
		</div>			
	</div>

</body>
</html>