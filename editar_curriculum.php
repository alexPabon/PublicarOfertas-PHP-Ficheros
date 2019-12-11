<?php
	session_start();
	if(!isset($_SESSION["user_log"]))
		header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>pendiente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
<?php require_once "templates/menu.php"; ?>
<h2 style="text-align: center;">Sin contenido</h2>
</body>
</html>