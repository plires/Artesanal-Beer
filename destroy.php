<?php
	session_start();
	session_destroy();
	setcookie("idUser", "", -1);
	header("location:login.php");exit;
?>