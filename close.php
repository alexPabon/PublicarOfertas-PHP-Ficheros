<?php
	
	session_start();
	unset($_SESSION["user_log"]);
	session_destroy();
	header("Location: index.php");

?>