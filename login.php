<?php
	session_start();
	if(isset($_SESSION["user_log"]))
		header("Location: index.php");

	$errorLogin = "";

	if($_POST)
	{
		if($_POST["tipo"]==1)
			$canal = fopen("files/empresa.txt", "r");
		
		if($_POST["tipo"]==0)
			$canal = fopen("files/personas.txt", "r");				
		
		
		$user = $_POST["user"];
		$pass = hash("sha512", $_POST["pass"]);

		while(!feof($canal)){
			$line = fgets($canal);
			$datos = explode("|", $line);
							
			if($user==$datos[4] && $pass==$datos[5]){
				$_SESSION["user_log"] = [$datos[1],$datos[4], $datos[2]];
				$_SESSION["datos"] = [$datos[0], $datos[1]];
				header("Location: index.php");
			}
		}

		$errorLogin = "No existe ningun usuario con estos datos";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/validar_login.js"></script>
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<form action="login.php" method="POST" id="login">
		<ul>
			<li><input type="text" name="user" class="log_int" id="user" placeholder="Usuario"></li>
			<li><input type="password" name="pass" class="log_int" id="pass" placeholder="Contraseña"></li>
			<li>
				<select id="seleccionar" class="log_int">
					<option disabled selected>-- Elije una opcion --</option>
					<option>Empresa</option>
					<option>Persona</option>
				</select>
				<input type="hidden" name="tipo" id="tipo">
			</li>
			<li><input type="button" name="login" id="entrar" value="Entrar"></li>
			<li class='error'><?= $errorLogin ?></li>
		</ul>		
		<p style="width: 300px;margin:0 auto;">
			<b>Empresa:</b><br>
			fedex pass:123456<br>
			fresh&co pass:123456<br>
			idEE pass:123456<br><br>
			<b>personas:</b><br>
			Alexxx pass:123456<br>
			pepito pass:123456<br>
			pepe pass:123456<br>
			manuel pass:123456<br>
		</p>		
	</form>
</body>
</html>