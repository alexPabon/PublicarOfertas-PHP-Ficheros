<?php
session_start();

//si el usuario esta logueado, no puede entrar en esta pagina, sino que lo redirecciona hacia index.php
//esto se hace para que el cliente no inicie sesion mas de una vez.
if(isset($_SESSION["user_log"]))
	header("Location: index.php");

if(isset($_POST["user"])){

	$canal = fopen("files/empresa.txt", "r");
	$contador=1;

	while(!feof($canal)){
		$line = fgets($canal);
		$contador++;
	}

	fclose($canal);
	
	//----------------------------------------------------------------------------
	//Guardar la imagen de perfil

	if($_FILES['user-img-file']["name"]==""){		
		$imagenP="imagenes/user-image/no-image.png";

	}else{					

		$usuario = $_POST["tipo"].$_POST["user"].$contador;
		$dirPath = realpath(dirname(getcwd()));

		$file = $_FILES['user-img-file'];		
		$fileTmpPath = $file['tmp_name'];
	    $fileName = $file['name'];
	    $fileSize = $file['size'];
	    $fileType = $file['type'];

	    $fileNameCmps = explode(".", $fileName);
	    $fileExtension = strtolower(end($fileNameCmps));
	    $newFileName = $usuario . '.' . $fileExtension;
	    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');


        $dirPath = realpath(dirname(getcwd())); //C:\xampp\htdocs
        $dirPath = $dirPath . '/' . 'proyecto/imagenes/user-image';

        if(!is_dir($dirPath)) mkdir($dirPath, 0755, true);
        $destPath = $dirPath . '/' . $newFileName;
        $files = glob($dirPath . '/*'); 			       

        if(move_uploaded_file($fileTmpPath, $destPath)){

            $imagenP='imagenes/user-image/'.$newFileName;			            
        }else{
          // echo 'Ha ocurrido un problema con la carga de la imagen. Inténtalo más tarde...';
       	} 
	}

	$canal = fopen("files/empresa.txt", "a");
	if(filesize("files/empresa.txt")>0){
		$line = PHP_EOL.$contador."|".$_POST["tipo"]."|".$imagenP."|".$_POST["nombre"]."|".$_POST["user"]."|".hash('sha512', $_POST["pass"])."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";

	}else{
		$line = $contador."|".$_POST["tipo"]."|".$imagenP."|".$_POST["nombre"]."|".$_POST["user"]."|".hash('sha512', $_POST["pass"])."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";
	}
	
	fputs($canal, $line);
	fclose($canal);

		//Se inserta la nuevas ofertas de cada empresa
	$canal = fopen("files/ofertas.txt", "r");
	$contaOfert=1;

	while(!feof($canal)){
		$line = fgets($canal);
		$contaOfert++;
	}

	fclose($canal);
	$canal = fopen("files/ofertas.txt", "a");
	if(filesize("files/ofertas.txt")>0){
		$line = PHP_EOL.$contaOfert."|".$contador."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";

	}else{
		$line = $contaOfert."|".$contador."|".$_POST["puesto"]."|".time()."|".json_encode($_POST["oferta"])."|";
	}
	
	fputs($canal, $line);

	$candidatos = fopen("files/candidatos.txt", "a");
	if(filesize("files/candidatos.txt")>0){
		$line = PHP_EOL.$contaOfert."|".$contador;

	}else{
		$line = $contaOfert."|".$contador;
	}
	
	fputs($candidatos, $line);
	fclose($candidatos);
	$_SESSION["user_log"] = [$_POST["tipo"], $_POST["user"],$imagenP];
	$_SESSION["datos"] = [$contador, 1];
	header("Location: index.php");							
}
		