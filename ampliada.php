<?php
	session_start();
	require_once "funciones/funciones.php";
	$listaAmpliada ="";

	if(isset($_GET["id"])){
		
		$id = $_GET["id"];
		$canal = fopen("files/empresa.txt", "r");
		$empresa=[];
		$oferta=[];

		while(!feof($canal)){
			$line = fgets($canal);
			$datos = explode("|", $line);
			
			if($datos[0]==$id){
				$empresa = $datos;
				break;
			}
		}

		fclose($canal);
		$canal = fopen("files/ofertas.txt", "r");
		
		while(!feof($canal)){
			$line = fgets($canal);
			$datos = explode("|", $line);
			
			if($datos[1]==$id)
				array_push($oferta, $datos);						
		}

		fclose($canal);
		$new_oferta = array_reverse($oferta);
	}

	foreach ($new_oferta as $value){
		//Comprueba si estan inscritos en la oferta
		$candidatos = fopen("files/candidatos.txt", "r");
		$candidatosInscritos = [];
		$usuario = $_SESSION["datos"][0];
		$flag = true;

		while(!feof($candidatos)){
			$line = trim(fgets($candidatos));
			$datos = explode("|", $line);
			
			if($datos[0]==$value[0])
				for ($i = 2; $i < count($datos); $i++)
				    if($usuario == $datos[$i])
						$flag =false;
		}

		fclose($candidatos);

	 	$contenido = str_replace("\r", "<br>", json_decode($value[4]));
	 	$listaAmpliada.= '<div class="marco_oferta">';
	 		$listaAmpliada.= '<div class="contenido">';
				$listaAmpliada.= '<h4>'.$value[2].'</h4>';
				$listaAmpliada.= '<p class="fecha">'.format_data($value[3]).'</p>';
				$listaAmpliada.= '<p>'.$contenido.'</p>';
			$listaAmpliada.= '</div>';
			
			if($flag){
				$listaAmpliada.= '<form action="inscribirse_oferta.php" method="post">';
					$listaAmpliada.= '<input type="hidden" name="oferta" value="'.trim($value[0]).'">';
					$listaAmpliada.= '<input type="hidden" name="empresa" value="'.trim($id).'">';
					$listaAmpliada.= '<input type="submit" value="Inscribirme en esta oferta">';
				$listaAmpliada.= '</form>';

			}else{
				$listaAmpliada.= '<p class="inscrito">Inscrito!</p>';
			}
			
		$listaAmpliada.= '</div>';
	}				
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= $empresa[3]; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/ampliada.css">
		<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
		<script type="text/javascript" src="js/ampliada.js"></script>
	</head>
	<body>
		<?php require_once "templates/menu.php"; ?>
		<header id="empresa">
			<h1><?= $empresa[3]; ?></h1>	
			<img class="imgEmpresa" src="<?php echo $empresa[2]; ?>">	
		</header>
		<div class="marco_ppal">
			<?= $listaAmpliada ?>
		</div>	
	</body>
</html>
