<?php
/* Include Funciones */
include_once('includes/funciones.php');

if (!$_SESSION) {
	header('Location: login.php');
} elseif ($_SESSION['recovery'] != 'on') {
	$_SESSION['modo'] = 'lectura'; // lockeo los input
}


/* Si se presiono "Editar" */
if (isset($_POST["editar"])) {

	// habilito todos los inputs
	$_SESSION['modo'] = '';

}

$errores = [];
$sucess = "";

/* Si se presiono "guardar" */
if (isset($_POST["guardar"])) {

	$errores = validarInformacionEditada($_POST);

	if (count($errores) == 0) { // No hubo errores
		$sucess = 'Datos guardados satisfactoriamente';
		$mensajeError ="";
		$_SESSION['modo'] = 'lectura';

		// capturo el id a editar y el nombre del archivo guardado
		$idAEditar = $_POST['id'];
		$archivo_cargado = $_SESSION['archivo'];

		// Creo el usuario editado
		$usuarioEditado = crearUsuarioEditado($_POST, $_SESSION, $_FILES, $idAEditar, $archivo_cargado);

		// piso el archivo a grabar sin el registro que se esta editando
		$listaDeUsuarios = traerTodosMenosUno($idAEditar);

		//Guardo los demas usuarios excepto el editado
		editarUsuario($listaDeUsuarios);

		// Guardo el usuario ya editado.
		guardarUsuario($usuarioEditado);

		// Logueo el usuario
		logeoDeUsuario($usuarioEditado);

		//Redirijo a la seccion de cuenta de usuario con la variable que indica el registro
		$_SESSION['modo'] = 'lectura';
        //header("Location:account.php");
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
			$archivo_cargado = $_FILES['archivo']['name'];
		}

	}

}



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


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Account User- Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "account"; ?>

	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!-- section resister start -->
	<section id="account">

		<!-- container start -->
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">

				<h1 class="text_center titulo_h1">Cuenta de Usuario de <?=$usuario?></h1>
				<hr class="margin_bottom_30">


				<!-- Notificaciones Form Start -->
				<div class="errores animated fadeInDown">

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
					<?=$sucess?>
				</div>		
				<!-- Notificaciones Form End -->		

				<form action="" method="post" enctype="multipart/form-data">

					<input name="id" class="no_visible" type="text" value="<?=$id?>">

					<div class="form_mitad_izq cont_imagen">
						<img class="account_img_user" src="upload/<?=$archivo?>" alt="<?=$archivo?>">
						<input class="archivo" type="file" name="archivo" id="archivo" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>
					</div>

					<div class="form_mitad_der">
						<label for="nombre">Nombre</label>
						<input <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> type="text" name="nombre" value="<?=$nombre?>">

						<label>Apellido</label>
						<input type="text" name="surname" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> value="<?=$apellido?>">

						<label for="document">Tipo de Documento</label>
							<select name="document" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayTipoDocumento as $clave => $valor) { ?>

								<?php if ($clave == $tipo_documento){ ?>
									<option value="<?=$clave?>" selected><?=$valor?></option>			
								<?php } else { ?>
									<option value="<?=$clave?>"><?=$valor?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->
							
						</select>

						<label for="numero">Numero</label><br>
						<input type="number" name="numero" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> value="<?=$numero?>">

						<label for="sex">Genero</label>
						<select name="sex" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayGenero as $clave => $valor) { ?>

								<?php if ($clave == $genero){ ?>
									<option value="<?=$clave?>" selected><?=$valor?></option>			
								<?php } else { ?>
									<option value="<?=$clave?>"><?=$valor?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->

						</select>

					</div>

					<div class="form_total">

						<label for="social">Estado Civil</label>
						<select name="social" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayEstadoCivil as $clave => $valor) { ?>

								<?php if ($clave == $estado_civil){ ?>
									<option value="<?=$clave?>" selected><?=$valor?></option>			
								<?php } else { ?>
									<option value="<?=$clave?>"><?=$valor?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->

						</select>						

						<label for="occupation">Ocupación</label>
						<select name="occupation" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>
							
							<!-- Array dinamico para el select de ocupacion START -->
							<?php

							foreach ($arrayOcupacion as $clave => $valor) { ?>

								<?php if ($clave == $ocupacion){ ?>
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
						<input type="number" name="cuit" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> value="<?=$cuit?>">

						<label for="correo">E-mail</label>
						<input type="email" name="correo" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> value="<?=$email?>">

						<label for="user">Usuario</label>
						<input type="text" name="user" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?> value="<?=$usuario?>">

						<label <?php if ($_SESSION['modo'] == 'lectura') echo "class=\"no_visible\""; ?> for="pass">Ingrese su contraseña</label>
						<input type="password" name="pass" <?php if ($_SESSION['modo'] == 'lectura') echo "class=\"no_visible\" disabled"; ?>>

						<label <?php if ($_SESSION['modo'] == 'lectura') echo "class=\"no_visible\""; ?> for="cpass">Reingrese su contraseña</label>
						<input type="password" name="cpass" <?php if ($_SESSION['modo'] == 'lectura') echo "class=\"no_visible\" disabled"; ?>>

						<div class="contenedor_auto">
							<input id="editar" type="submit" name="editar" value="Editar">
							<input id="guardar" type="submit" name="guardar" value="Guardar cambios" <?php if ($_SESSION['modo'] == 'lectura') echo "disabled"; ?>>
						</div>

					</div>

				</form>		  	

			</div>
			<!--Sub - container end-->

		</div>
		<!-- container end -->

	</section>
	<!-- section resister end -->

	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	
</body>
</html>