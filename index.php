<?php
	session_start();
	require_once "funciones/funciones.php";
	$datosEmpresa = "";	
	
	if(isset($_SESSION["datos"])){

		$usario = $_SESSION["datos"][1];

		if($usario==1){
			$canal = fopen("files/personas.txt", "r");
			$ofertas = [];				
			
			while(!feof($canal)){
				$line = fgets($canal);
				$datos = explode("|", $line);
				array_push($ofertas, $datos);
			}
			
			$new_ofertas = array_reverse($ofertas);

			fclose($canal);

			foreach($new_ofertas as $value){
				$nombreApell = $value[3]." ".$value[6];
				$imagen = $value[2];
				$ciudad = $value[9];
				$experiencia = str_replace("\r", "<br>", json_decode($value[14]));
				
				$datosEmpresa.= "<a href=curriculum.php?id=$value[0]>";
					$datosEmpresa.= "<div class='reducida'>";
						$datosEmpresa.= '<h3 class="empresa"><img class="img_perfil0" src="'.$imagen.'">'.strtoupper($nombreApell).'</h3>';							
						$datosEmpresa.= "<p class='ciudad'>".$ciudad."</p>";
						$datosEmpresa.= "<p class='titulo'>".substr($experiencia,0,250)."...."."</p>";
					$datosEmpresa.= "</div>";
				$datosEmpresa.= "</a>";			
			}

		}else if($usario==0){

			$canal = fopen("files/empresa.txt", "r");
			$ofertas = [];				
			
			while(!feof($canal)){
				$line = fgets($canal);
				$datos = explode("|", $line);
				array_push($ofertas, $datos);
			}
			
			$new_ofertas = array_reverse($ofertas);

			fclose($canal);

			foreach($new_ofertas as $value){
				$contenido = str_replace("\r", "<br>", json_decode($value[8]));
				$datosEmpresa.= "<a href=ampliada.php?id=$value[0]>";
					$datosEmpresa.= "<div class='reducida'>";
						$datosEmpresa.= '<h3 class="empresa"><img class="img_perfil1" src="'.$value[2].'">'.strtoupper($value[3]).'</h3>';							
						$datosEmpresa.= "<p class='fecha'>".$value[6]." "."  ".format_data($value[7])."</p>";
						$datosEmpresa.= "<p class='titulo'>".substr($contenido,0,150)."...."."</p>";
					$datosEmpresa.= "</div>";
				$datosEmpresa.= "</a>";			
			}
		}
		
	}else{

		$canal = fopen("files/empresa.txt", "r");
		$ofertas = [];				
		
		while(!feof($canal)){
			$line = fgets($canal);
			$datos = explode("|", $line);
			array_push($ofertas, $datos);
		}
		
		$new_ofertas = array_reverse($ofertas);

		fclose($canal);

		foreach($new_ofertas as $value){
			$contenido = str_replace("\r", "<br>", json_decode($value[8]));
			$datosEmpresa.= '<div class="portada">';
				$datosEmpresa.= '<div class="reducida">';
					$datosEmpresa.= '<h3 class="empresa"><img class="img_perfil1" src="'.$value[2].'">'.strtoupper($value[3]).'</h3>';							
					$datosEmpresa.= "<p class='fecha'>".$value[6]." "."  ".format_data($value[7])."</p>";
					$datosEmpresa.= "<p class='titulo'>".substr($contenido,0,150)."...."."</p>";
				$datosEmpresa.= "</div>";
			$datosEmpresa.= "</div>";			
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Trabajar</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<?php require_once "templates/menu.php"; ?>
		<div><p style="text-align: center;">Cada vez que una empresa publique una oferta de trabajo, esta se pondrá de primera en la lista</p></div>
		<div class="marco_ppal">
			<?= $datosEmpresa ?>
		</div>		
	</body>
</html>
