<?php
	if(isset($_SESSION["user_log"]))
	{
		if($_SESSION["user_log"][0]==1)
		{
?>
			<nav>
				<a style="font-size: 30px;" href="index.php">Inicio</a>
				<div class="user-items"><?php echo '<img class="img_perfil" src='.$_SESSION["user_log"][2].'>' ?></div>
				<div class="user-items">
					<p class="n_usu">Hola <?php echo $_SESSION["user_log"][1]; ?></p>
					<a href="candidatos.php">Mis Candidatos</a>
					<a href="insert_oferta.php">Publicar Empleo</a>					
					<a href="close.php">Cerrar sesión</a>
				</div>
			</nav>

<?php
		} 
		else if($_SESSION["user_log"][0]==0)
		{
?>
			<nav>
				<a style="font-size: 30px;" href="index.php">Inicio</a>
				<div class="user-items"><?php echo '<img class="img_perfil" src='.$_SESSION["user_log"][2].'>' ?></div>
				<div class="user-items">
					<p class="n_usu">Hola <?php echo $_SESSION["user_log"][1]; ?></p>
					<a href="editar_curriculum.php">Editar curriculum</a>
					<a href="close.php">Cerrar sesión</a>
				</div>								
			</nav>
<?php
		}
	}
	else
	{
?>
		<nav>
			<a href="index.php">Inicio</a>			
			<div class="user-items">
				<a href="login.php" style="margin-right: 1.5vw">Iniciar Sesion</a>
				<a href="registro.php">Registrarse</a>
			</div>
		</nav>
<?php
	}
?>
