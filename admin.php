<?php
/* Include Funciones */
include_once('soporte.php');


if (!$auth->estaLogueado() || $objetoUsuarioLogueado->getUsuario() != 'administrador') {
	header("location:account.php");exit;
}


if (isset($_POST['sistema'])) {
	if ($_POST['soporte'] == 'sql') {
		$fp = fopen('sistema.php', 'w');
		fwrite($fp, '<?php $soporte = "sql"; ?>');
		fclose($fp);
		header("location:destroy.php");exit;
	} else {
		$fp = fopen('sistema.php', 'w');
		fwrite($fp, '<?php $soporte = "json"; ?>');
		fclose($fp);
		header("location:destroy.php");exit;
	}
}

/* Si se presiono "Migrar" */
if (isset($_POST['migra'])) {
	$usuarios = $db->getRepositorioUsuarios()->traerTodos();

	$fp = fopen('sistema.php', 'w');
	fwrite($fp, '<?php $soporte = "sql"; ?>');
	fclose($fp);
	$db = new RepositorioSQL();
	
	$db->getRepositorioUsuarios()->crearBaseDeDatos();
	$db->getRepositorioUsuarios()->borrarTablaUsuarios();
	$db->getRepositorioUsuarios()->cargarTablaUsuarios($usuarios);
	$db->getRepositorioUsuarios()->cambiarSistemaAJson();
	header("location:admin.php");exit;

}

// lockeo el input de migrar datos si el soporte en curso es sql.
$inputs = ($soporte == 'sql') ? 'disabled' : 'enabled';


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin User- Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link id="cssArchivo" href="css/styles.css" rel="stylesheet">
</head>
<body>
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "admin"; ?>

	<!--Include HEADER-->
	<?php include_once('includes/header.php');?>
				




	&nbsp;<br>
	<!-- section resister start -->
	<section id="admin">

	    <!-- container start -->
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">

				<h1 class="text_center titulo_h1">Administración del sitio</h1>
				<hr class="margin_bottom_30">

				<h3>Establecer el soporte del sistema</h3>

				<form id="admin" action="admin.php" method="post">
					<?php if ($soporte == 'sql') { ?>
						<input type="radio" name="soporte" checked value="sql">Soporte SQL<br>
						<input type="radio" name="soporte" value="json">Soporte JSON<br>
					<?php } else { ?>
						<input type="radio" name="soporte" value="sql">Soporte SQL<br>
						<input type="radio" name="soporte" checked value="json">Soporte JSON<br>
					<?php } ?>
					&nbsp;<br>
					<input name="sistema" id="sistema" type="submit" value="Enviar">
				</form>

				<hr class="margin_bottom_30">

				
				<?php

				if ($soporte == 'json') {
				echo "<h3>Listado de usuarios de la BDD en Json</h3>";
				$usuarios = $db->getRepositorioUsuarios()->traerTodos();

					foreach ($usuarios as $usuario) {?>
						<img width="100" class="admin_img_user" src="<?=$usuario->getFoto()?>" alt="<?=$usuario->getNombre()?>">
						<h4 class="titulo_admin">Nombre y Apellido: <span class="tipo_normal"><?=$usuario->getNombre() . ' ' . $usuario->getApellido()?></span></h4>
						<h5 class="titulo_admin">Mail: <span class="tipo_normal"><?=$usuario->getMail();?></span></h5>
						<h5 class="titulo_admin">Usuario: <span class="tipo_normal"><?=$usuario->getUsuario();?></span></h5>
						<hr class="margin_bottom_30">
						
					<?php
					}				
					
				} else {
					echo "<h3>Aviso Importante</h3>";
					echo "<p>Para poder ver los usuarios de la base de datos en Json y migrar los datos a SQL debe cambiar el soporte del sitio a modo JSON.</p>";
				} 


				?>
				
				
				<form id="migracion" action="admin.php" method="post">
					<input <?php if ($inputs == "disabled") echo "disabled"; ?> name="migra" id="migra" type="submit" value="Migrar usuarios de JSON a SQL">
				</form>

				<hr class="margin_bottom_30">


	  	

			</div>
			<!--Sub - container end-->

		</div>
		<!-- container end -->
  	</section>
	<!-- section resister end -->

	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/confirmaciones.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/contador.js"></script>

	<script>
		window.onload = contador;
	</script>
	
</body>
</html>