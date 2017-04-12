<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "login"; ?>

	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!-- container start -->
	<div class="container">

		<!--Sub - container Start-->
		<div class="sub_container">

			<h1 class="text_center titulo_h1">Login de usuario</h1>

			<!-- section resister start -->
			<section id="login" class="main-content">

			    <div class="register">

					<!-- formulario start -->
				    <form action="script.php" method="post">
				    
						<fieldset>
							<legend>Login de Usuario</legend>

							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" value="" required>

							<label for="pass">Contraseña</label>
							<input type="password" name="pass" value="" required>

							<a href="register.php">Aún no sos usuario?</a><br>
							<a href="#">Olvidaste tu contraseña?</a><br>
							&nbsp;<br>

							<input type="checkbox" name="pass_recordar" value="RP">Recordar la contraseña<br> 

							<div class="contenedores_button">
								<button id="enviar" type="submit" name="enviar">Enviar</button>
								<button id="reset" type="reset" name="reset">Borrar</button>							
							</div>

						</fieldset>
				    </form>
					<!-- formulario end -->

			    </div>
		  	</section>
			<!-- section resister end -->

		</div>
		<!--Sub - container end-->

	</div>
	<!-- container end -->

	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	
</body>
</html>