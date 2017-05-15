<?php
/* Include Funciones */
include_once('includes/funciones.php');

if ($_SESSION) {
	header('Location: account.php');
}

$nombre = "";
$apellido = "";
$numero = "";
$cuit = "";
$correo = "";
$user = "";
$pass = "";
$cpass = "";
$archivo = "";
$mensajeError ="";
$sucess ="";

/* Creo los array para formar los select */

$arrayTipoDocumento = [
	"DNI" => "DNI",
	"Pasaporte" => "Pasaporte",
	"Libreta_enrolamiento" => "Libreta de enrolamiento",
	"Libreta_civica" => "Libreta Cívica"
];

$arrayGenero = [
	"Masculino" => "Masculino",
	"Femenino" => "Femenino",
	"Sin_Datos" => "Sin Datos"
];

$arrayEstadoCivil = [
	"Soltero" => "Soltero",
	"Casado" => "Casado",
	"Viudo/a" => "Viudo/a",
	"Divorciado/a" => "Divorciado/a",
	"Otro" => "Otro"
];

$arrayOcupacion = [
	"Monotributista" => "Monotributista",
	"Autonomo" => "Autonomo",
	"Pensionado" => "Pensionado",
	"Jubilado" => "Jubilado",
	"ama_de_casa" => "Ama de casa",
	"Estudiante" => "Estudiante",
	"Desocupado" => "Desocupado",
	"Empleado" => "Empleado",
	"Otro" => "Otro"
];

$errores = [];

if ($_POST) {
	$errores = validarInformacion($_POST);

	if (count($errores) == 0) { // No hubo errores
		$sucess = 'Datos guardados satisfactoriamente';
		$mensajeError ="";

		// Creo el Usuario
		$usuario = crearUsuario($_POST);

		//Guardo el usuario
		guardarUsuario($usuario);

		// Logueo el usuario
		logeoDeUsuario($usuario);

		//Redirijo a la seccion de cuenta de usuario con la variable que indica el registro
		$_SESSION['modo'] = 'lectura';
        header("Location:account.php");
	} else { // Hubo errores.
		$mensajeError = 'Sabemos que pedimos son muchos datos...pero lo hacemos por tu bien :)';

		if (!isset($errores['nombre'])) {
			$nombre = $_POST['nombre'];
		}

		if (!isset($errores['surname'])) {
			$apellido = $_POST['surname'];
		}

		if (!isset($errores['numero'])) {
			$numero = $_POST['numero'];
		}

		if (!isset($errores['cuit'])) {
			$cuit = $_POST['cuit'];
		}

		if (!isset($errores['correo'])) {
			$correo = $_POST['correo'];
		}

		if (!isset($errores['user'])) {
			$user = $_POST['user'];
		}

		if (!isset($errores['archivo'])) {
			$archivo = $_FILES['archivo']['name'];
		}
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de Usuario - Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>

	<!--Variable que activa la clase en NAV-->
	<?php $activo = "register"; ?>

	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!-- container start -->
	<div class="container">

		<!--Sub - container Start-->
		<div class="sub_container">

			<h1 class="text_center titulo_h1">Registro de usuario</h1>

			<!-- Notificaciones Form Start -->
			<div class="errores animated fadeInDown">

				<h5><?=$mensajeError?></h5>

				<?php

				if (count($errores) > 0) {
					foreach ($errores as $error) { ?>
						<ul>
							<li><?php echo $error; ?></li>
						</ul>		
					 <?php }
				}

				?>
			
			</div>

			<div class="sucess animated fadeInDown">
				<h5><?=$sucess?></h5>
			</div>		
			<!-- Notificaciones Form End -->

			<!-- section resister start -->
			<section id="formulario_registro" class="main-content">

			    <div class="register">

					<!-- formulario start -->
				    <form action="" method="post" enctype="multipart/form-data">
				    
						<fieldset>
							<legend>Datos Personales</legend>

							<label for="name">Nombre</label>
							<input type="text" name="nombre" value="<?=$nombre?>">

							<label>Apellido</label>
							<input type="text" name="surname" value="<?=$apellido?>">

							<label for="document">Tipo de Documento</label>
							<select name="document">
								
								<!-- Array dinamico para el select de documento START -->
								<?php

								foreach ($arrayTipoDocumento as $clave => $valor) { ?>

									<?php if ($clave == $_POST['document']){ ?>
										<option value="<?=$clave?>" selected><?=$valor?></option>			
									<?php } else { ?>
										<option value="<?=$clave?>"><?=$valor?></option>
									<?php } ?>

								<?php
								}

								?>
								<!-- Array dinamico para el select de documento END -->

							</select>

							<label for="numero">Numero</label>
							<input type="number" name="numero" value="<?=$numero?>">

							<label for="sex">Genero</label>
							<select name="sex">

								<!-- Array dinamico para el select de genero START -->
								<?php

								foreach ($arrayGenero as $clave => $valor) { ?>

									<?php if ($clave == $_POST['sex']){ ?>
										<option value="<?=$clave?>" selected><?=$valor?></option>			
									<?php } else { ?>
										<option value="<?=$clave?>"><?=$valor?></option>
									<?php } ?>

								<?php
								}

								?>
								<!-- Array dinamico para el select de genero END -->

							</select>

							<label for="social">Estado Civil</label>
							<select name="social">
								
								<!-- Array dinamico para el select de estado civil START -->
								<?php

								foreach ($arrayEstadoCivil as $clave => $valor) { ?>

									<?php if ($clave == $_POST['social']){ ?>
										<option value="<?=$clave?>" selected><?=$valor?></option>			
									<?php } else { ?>
										<option value="<?=$clave?>"><?=$valor?></option>
									<?php } ?>

								<?php
								}

								?>
								<!-- Array dinamico para el select de estado civil END -->

							</select>

							<label for="occupation">Ocupación</label>
							<select class="" name="occupation">

								<!-- Array dinamico para el select de ocupacion START -->
								<?php

								foreach ($arrayOcupacion as $clave => $valor) { ?>

									<?php if ($clave == $_POST['occupation']){ ?>
										<option value="<?=$clave?>" selected><?=$valor?></option>			
									<?php } else { ?>
										<option value="<?=$clave?>"><?=$valor?></option>
									<?php } ?>

								<?php
								}

								?>
								<!-- Array dinamico para el select de ocupacion END -->

							</select>

							<label for="cuit">CUIT</label>
							<input type="number" name="cuit" value="<?=$cuit?>">

							<label for="correo">E-mail</label>
							<input type="email" name="correo" value="<?=$correo?>">

							<label>Nombre de usuario</label>
							<input type="text" name="user" value="<?=$user?>">

							<label for="pass">Ingrese su contraseña</label>
							<input type="password" name="pass" value="<?=$pass?>">

							<label for="cpass">Reingrese su contraseña</label>
							<input type="password" name="cpass">

							<label>Imágen de perfil</label>
							<input type="file" name="archivo" id="archivo" value="<?=$archivo?>">

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