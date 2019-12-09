<?php
	session_start();

	function format_data($time)
	{
		$mescat=array(" ","Gen","Feb","Mar","Abr","Mai","Jun","Jul","Ago","de Sep","de Oct","de Nov","de Dec");
		$dia=date("d",$time);
		$mes=$mescat[date ("n",$time)];
		$any=date ("Y",$time);
		$data=$dia.'/'.$mes.'/'.$any;
		return $data;
	}

	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$canal = fopen("files/empresa.txt", "r");
		$empresa=[];
		$oferta=[];
		while(!feof($canal))
		{
			$line = fgets($canal);
			$datos = explode("|", $line);
			
			if($datos[0]==$id)
			{
				$empresa = $datos;
				break;
			}
		}
		fclose($canal);
		$canal = fopen("files/ofertas.txt", "r");
		while(!feof($canal))
		{
			$line = fgets($canal);
			$datos = explode("|", $line);
			
			if($datos[1]==$id)
			{
				array_push($oferta, $datos);			
			}
		}
		fclose($canal);

		$new_oferta = array_reverse($oferta);

	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $empresa[3]; ?></title>
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
		<h1><?php echo $empresa[3]; ?></h1>	
		<img class="imgEmpresa" src="<?php echo $empresa[2]; ?>">	
	</header>
	<div class="marco_ppal">
		<?php 
			foreach ($new_oferta as $value)
			{
				//Comprueba si estan inscritos en la oferta
				$candidatos = fopen("files/candidatos.txt", "r");
				$candidatosInscritos = [];
				$usuario = $_SESSION["datos"][0];
				$flag = true;
				while(!feof($candidatos))
				{
					$line = trim(fgets($candidatos));
					$datos = explode("|", $line);
					
					if($datos[0]==$value[0])
					{
						for ($i = 2; $i < count($datos); $i++)
						{
						    if($usuario == $datos[$i])
							{
								$flag =false;
								
							}
							else
							{
								 
							}
						}
					}
				
				}
				fclose($candidatos);


			 	$contenido = str_replace("\r", "<br>", json_decode($value[4]));
			 	echo '<div class="marco_oferta">';
			 		echo '<div class="contenido">';
						echo '<h4>'.$value[2].'</h4>';
						echo '<p class="fecha">'.format_data($value[3]).'</p>';
						echo '<p>'.$contenido.'</p>';
					echo '</div>';
					if($flag)
					{
						echo '<form action="inscribirse_oferta.php" method="post">';
							echo '<input type="hidden" name="oferta" value="'.trim($value[0]).'">';
							echo '<input type="hidden" name="empresa" value="'.trim($id).'">';
							echo '<input type="submit" value="Inscribirme en esta oferta">';
						echo '</form>';
					}
					else
					{
						echo '<p class="inscrito">Inscrito!</p>';
					}
					
				echo '</div>';
			}			
		 ?>
	</div>
	
		
		
	</form>
</body>
</html>
