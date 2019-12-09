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
	<title><?php echo $_SESSION["user_log"][1] ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/detalles_candidatos.css">	
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<h1 id="puesto"><?php echo $_GET["puesto"]; ?></h1>
	<div class="marco_ppal">
		<?php
			//Comprueba si estan inscritos en la oferta
			$candidatos = fopen("files/candidatos.txt", "r");
			$candidatosInscritos = [];
			$oferta = $_GET["id"];
			
			while(!feof($candidatos))
			{
				$line = trim(fgets($candidatos));
				$datos = explode("|", $line);
				
				if($datos[0]==$oferta)
				{
					for ($i = 2; $i < count($datos); $i++)
					{
					    array_push($candidatosInscritos, $datos[$i]);
					}
				}
			
			}
			fclose($candidatos);
			
			for ($j = 0; $j < count($candidatosInscritos); $j++)
			{
				$curriculum = fopen("files/personas.txt", "r");
				echo '<div class="candidatos">';
			    while (!feof($curriculum))
			    {
			    	$line = fgets($curriculum);
					$datos = explode("|", $line);
					
					if($datos[0]==$candidatosInscritos[$j])
					{
						$id = $datos[0];
						$nombreApell = strtoupper($datos[3])." ".strtoupper($datos[6]);
						$ciudad = $datos[9];
						$experiencia = str_replace("\r", "<br>", json_decode($datos[14]));

						echo '<a href="curriculum.php?id='.$id.'"><p class="datosPersonales">'.$nombreApell.'<br><span class="fecha">'.$ciudad.'<br><br>Experiencia:<br></span class="experiencia"><br>'.substr($experiencia,0,150).'....</span></p></a>';
						
					}						
			    }
			    echo '</div>';
			    fclose($curriculum);		
			}
		?>
	</div>
</body>

</html>