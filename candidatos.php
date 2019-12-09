<?php
session_start();

if($_SESSION["datos"][1]!=1)
{
	header("location: index.php");
}

function format_data($time)
{
	$mescat=array(" ","Gen","Feb","Mar","Abr","Mai","Jun","Jul","Ago","de Sep","de Oct","de Nov","de Dec");
	$dia=date("d",$time);
	$mes=$mescat[date ("n",$time)];
	$any=date ("Y",$time);
	$data=$dia.'/'.$mes.'/'.$any;
	return $data;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mis Ofertas</title>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/candidatos.css">	
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>	
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<header>
		<h2>Aqui tengo todas mis ofertas que he publicado</h2>
		<p>Cuando damos click un cualquiera de ellas podemos ver todas las personas que se ha inscrito en esta oferta.</p>
	</header>
	<div class="marco_ppal">
		<?php
			//Encuentra todas las ofertas de esta empreas y las escrible
			$oferta = fopen("files/ofertas.txt", "r");
			$ofertaInscritos = [];
			$empresa = $_SESSION["datos"][0];	
			
			while(!feof($oferta))
			{
				$line = fgets($oferta);
				$datos = explode("|", $line);
				
				if($datos[1]==$empresa)
				{
					$id = $datos[0];
					$puesto = $datos[2];
					$fecha = format_data($datos[3]);

					echo '<a href="detalles_candidatos.php?id='.$id.'&puesto='.$puesto.'"><p class="puestos">'.$puesto.'<br><span class = "fecha">'.$fecha.'</p></a>';					
				}
			
			}
			fclose($oferta);
		?>
	</div>

</body>
</html>