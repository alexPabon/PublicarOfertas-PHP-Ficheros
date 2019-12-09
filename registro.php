<?php
	session_start();
	$refrescar = false;
	if(isset($_SESSION["user_log"]))
	{
		header("Location: index.php");
	}
	else
	{
		if($refrescar){header("Refresh:0");}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrate</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/registro.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/validar.js"></script>
	<script type="text/javascript" src="js/registro.js"></script>
	<script type="text/javascript" src="js/validar_empresa.js"></script>

</head>
<body>
	<?php require_once "templates/menu.php";?>

	<div id="opcion">	
		<select id="seleccionar">
			<option>---Elige una opcion---</option>
			<option value="1">Empresa</option>
			<option value="2">Persona</option>
			<input type="button" value="Comenzar Registro">
			<p id="error"></p>
		</select>
	</div>

	<div class="wrapper">
		<div class="marcos" id="persona">			
			<form action="persona.php" method="post" enctype="multipart/form-data" id="regis">
				
				<fieldset id="d_pers">
					<legend>Datos personales</legend>
					<div class="img-box">
						<img src="imagenes/no-image.png" id="user-img">
						<p id="error_img" style="margin:0;padding: 3px 0;"></p>
						<input type="file" id="user-img-file" accept=".jpg,.jpeg,.png" name="user-img-file">
						<label for="user-img-file" class="center" id="lbl_img">
							Click aquí para subir imagen (2MB máx).
						</label>						
					</div>
					<ul>
						<li>							
							<label for="nombre">Nombre:</label>
							<input type="text" class="info" name="nombre" id="nombre">
							<p class="nota"></p>
						</li>
						<li>
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="info" name="apellidos" id="apellidos">
							<p class="nota"></p>
						</li>						
						<li>
							<label for="dni">DNI:</label>
							<input type="text" class="info" name="dni" id="dni">
							<p class="nota"></p>
						</li>
						<li>
							<label for="direc">Direccion:</label>
							<input type="text" class="info" name="direccion" id="direc">
							<p class="nota"></p>
						</li>
						<li>
							<label for="ciudad">Ciudad:</label>
							<input type="text" class="info" name="ciudad" id="ciudad">
							<p class="nota"></p>
						</li>
						<li>
							<label for="tel">Telefono:</label>
							<input type="text" class="info" name="tel" id="tel">
							<p class="nota"></p>
						</li>
						<li>
							<label for="correo">Email:</label>
							<input type="email" class="info" name="correo" id="correo">
							<p class="nota"></p>
						</li>
						<li>
							<p></p>
						</li>
						<li><input type="text" class="info" name="user" placeholder="Usuario" id="user"></li>
						<li><input type="password" class="info" name="pass" placeholder="Contraseña" id="pass"></li>
						<li><input type="password" class="info" placeholder="Repita contraseña" id="pass1"></li>
						<li>
							<p id="error_pass"></p>
						</li>
						<li>
							<label></label>
							<input type="hidden" name="fch" id="fch">
							<label for="fechaNac">Fecha Nac:</label>
							<input type="Date" class="info" id="fechaNac">
							<p class="nota"></p>
						</li>
						<li>
							<label for="estado">Estado civil:</label>
							<select class="estado" id="estado" name="estado">
								<option value="0">---</option>
								<option value="soltero">Soltero</option>
								<option value="casado">Casado</option>		
							</select>
							<p class="nota"></p>
						</li>					
					</ul>
				</fieldset>			
				<fieldset id="experiencia">
					<legend>Experiencia</legend>
					<textarea name="experiencia" class="masDatos" id="expe">--</textarea>
					<input type="button" value="Experiencia" id="exp">				
				</fieldset>
			
				<fieldset id="idiomas">
					<legend>Idiomas</legend>
					<textarea name="idiomas" class="masDatos" id="idio">--</textarea>
					<input type="button" value="Idiomas">
				</fieldset>
			
				<fieldset id="aficiones">
					<legend>Aficiones</legend>
					<textarea name="aficiones" class="masDatos" id="afic">--</textarea>
					<input type="button" value="Aficiones">
				</fieldset>
			
				<fieldset id="enlaces">
					<legend>Páginas de interés</legend>
					<textarea name="enlaces" class="masDatos" id="enl">--</textarea>
					<input type="button" value="Enlaces">
				</fieldset>
				<input type="hidden" name="tipo" value="0">
				<input type="button" name="persona" value="Guardar Datos" id="enviar">
			
			</form>
		</div>
		<div class="marcos" id="empresa">			
			<form action="empresa.php" method="POST" enctype="multipart/form-data" id="registro">
				<fieldset>
					<div class="img-box">
						<img src="imagenes/no-image.png" id="user-img1">
						<p id="error_img1" style="margin:0;padding: 3px 0;"></p>
						<input type="file" id="user-img-file1" accept=".jpg,.jpeg,.png" name="user-img-file">
						<label for="user-img-file1" class="center" id="lbl_img">
							Click aquí para subir imagen (2MB máx).														
						</label>						
					</div>
					<ul>
						<li><input type="text" class="info" name="nombre" placeholder="Nombre Empresa"></li>
						<li><input type="text" class="info" name="user" placeholder="Usuario"></li>
						<li><input type="password" class="info" name="pass" placeholder="Contraseña" id="pass2"></li>
						<li><input type="password" class="info" name="repite_pass" placeholder="Repita contraseña" id="pass3"></li>
						<li><p id="error_pass1"></p></li>
						<li>
							<li><input type="text" class="info" name="puesto" placeholder="Puesto vacante"></li>
							<textarea name="oferta" id="oferta"></textarea>
							<p id="error_txt" class="nota"></p>
						</li>	
						<li>
							<input type="hidden" name="tipo" value="1">
							<input type="button" name="Enviar" value="Registrate" id="empr">
						</li>						
					</ul>
				</fieldset>	
			</form>
		</div>
	</div>
</body>
</html>