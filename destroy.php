<?php
	session_start();
	session_destroy();
	setcookie("id", "", -1);
	header("location:login.php");exit;
?>
