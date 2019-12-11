<?php
	session_start();	
	$mensajeError = "";

	if($_SESSION["datos"][1]!=1)
		header("location: index.php");

	if($_POST){

		if($_POST['puesto']!="" && $_POST['oferta']!=""){
			// var_dump($_POST);
			// echo "<br>";
			// var_dump($_SESSION["datos"]);

			$canal = fopen("files/empresa.txt","r");
			$nw_oferta =[];

			while (!feof($canal)){
				$line = trim(fgets($canal));
				$datos = explode("|", $line);

				if($datos[0]==$_SESSION["datos"][0]){
					$datos[6] = $_POST["puesto"];
					$datos[7] = time();
					$datos[8] = json_encode($_POST["oferta"]);
					$nw_datos = implode("|", $datos);
					$lineaActualizada = $nw_datos;

				}else{
					$nw_datos = implode("|", $datos);
					array_push($nw_oferta, $nw_datos);
				}				
			}

			array_push($nw_oferta, $lineaActualizada);

			fclose($canal);			

			$canal = fopen("files/empresa.txt", "w");
			$primeraLinea = 0;

			foreach($nw_oferta as $value){

				if($primeraLinea==0)
					fputs($canal,$value);
				else
					fputs($canal, PHP_EOL.$value);

				$primeraLinea++;
			}

			fclose($canal);

			$oferta = fopen("files/ofertas.txt", "r");
			$contador = 1;

			while(!feof($oferta)){
				fgets($oferta);
				$contador++;
			}

			fclose($oferta);

			$oferta = fopen("files/ofertas.txt", "a");

			if(filesize("files/ofertas.txt")>0){
				$line = PHP_EOL.$contador."|".$_SESSION["datos"][0]."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";

			}else{
				$line = $contador."|".$_SESSION["datos"][0]."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";
			}

			fputs($oferta,$line);
			fclose($oferta);

			$candidatos = fopen("files/candidatos.txt", "a");
			if(filesize("files/candidatos.txt")>0)
				$line = PHP_EOL.$contador."|".$_SESSION["datos"][0];
			else
				$line = $contador."|".$_SESSION["datos"][0];
			
			fputs($candidatos, $line);
			fclose($candidatos);
			header("location: index.php");
		}else{
			$mensajeError = "Debe llenar escribir el puesto de la oferta y la descripcion";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION["user_log"][1] ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/insert_oferta.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/insert_oferta.js"></script>
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<header>
		<h1><?= $_SESSION["user_log"][1] ?></h1>		
		<img class="imgEmpresa" src="<?= $_SESSION["user_log"][2]; ?>">	
	</header>
	<div class="marco_ppal">
		<p><?= $mensajeError ?></p>
		<form action="insert_oferta.php" method="post" id="g_oferta">
			<ul>				
				<li><label style="color: white;">Puesto a ofertar</label></li>
				<li><input type="text" name="puesto"></li>
				<li><textarea name="oferta" placeholder="Descripcion"></textarea></li>
				<li><input type="button" value="Guardar" id="guardar"></li>				
			</ul>		
		</form>		
	</div>
</body>
</html>