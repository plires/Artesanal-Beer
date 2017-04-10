<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>

	<!-- container start -->
	<div class="container">

		<!-- section resister start -->
		<section id="formulario_registro" class="main-content">

		    <h2>REGISTRO DE USUARIO</h2>
		    <div class="register">

				<!-- formulario start -->
			    <form action="script.php" method="post">
			    
					<fieldset>
						<legend>Datos Personales</legend>

						<label for="name">Nombre</label>
						<input type="text" name="name" value="" required>

						<label>
						Apellido
						</label>
						<input type="text" name="surname" value="" required>

						<label for="document">Tipo de Documento</label>
							<select name="document" name="type-of-id" required>
							<option value="dni">Documento de Identidad</option>
							<option value="pass">Pasaporte</option>>
							<option value="libenrol">Libreta de Enrrolamiento</option>
							<option value="libretaciv">Libreta Civica</option>
						</select>

						<label for="numero">Numero</label>
						<input type="number" name="numero" value="" required>

						<label for="sex">Genero</label>
							<select name="sex" required="">
							<option value="male">Masculino</option>
							<option value="female">Femenino</option>
							<option value="sd">Sin Datos</option>
						</select>

						<label for="social">Estado Civil</label>
						<select class="" name="social" required="">
							<option value="single">Soltero/a</option>
							<option value="married">Casado/a</option>
							<option value="widowed">Viudo/a</option>
							<option value="Divorced">Divorciado/a</option>
							<option value="other">Otro/a</option>
						</select>

						<label for="occupation">Ocupación</label>
						<select class="" name="occupation" required="">
							<option value="mono">Monotributista</option>
							<option value="auto">Autonomo</option>
							<option value="pensio">Pensionado</option>
							<option value="jubil">Jubilado</option>
							<option value="amade">Ama de Casa</option>
							<option value="estud">Estudiante</option>
							<option value="desocp">Desocupado</option>
							<option value="empleadorel">Empleado en relacion de dependencia</option>
							<option value="other">Otro</option>
						</select>

						<label for="cuit">CUIT</label>
						<input type="number" name="cuit" value="" required="">

						<label for="correo">E-mail</label>
						<input type="email" name="correo" value="" required="">

						<label for="rcorreo">Reingrese el E-mail</label>
						<input type="e-mailr" name="rcorreo" value="" required="">

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
	<!-- container end -->

	<?php include_once('includes/footer.php'); ?>

	
</body>
</html>