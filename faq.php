<?php

/* Include Funciones */
include_once('includes/funciones.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FAQ - Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>

	<!--Variable que activa la clase en NAV-->
	<?php $activo = "faq"; ?>
	
	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!-- container start -->
	<div class="container">

		<!--Sub - container Start-->
		<div class="sub_container">

			<h1 class="text_center titulo_h1">Preguntas Frecuentes</h1>
			<hr class="margin_bottom_30">

			<ul id="preguntas" class="margin_bottom_30">
				<li><a class="faq_preguntas" href="#productos">Que productos comercializamos?</li></a>
				<li><a class="faq_preguntas" href="#servicios">Ofrecen servicios para eventos?</li></a>
				<li><a class="faq_preguntas" href="#pagos">Cuáles son las formas de pago?</li></a>
				<li><a class="faq_preguntas" href="#terminos">Cuáles son los términos y condiciones del sitio?</li></a>
			</ul>

			<!-- section resister start -->
			<section id="faq">

				<h2 id="productos" class="h2_faq">
					Que productos comercializamos?
					<a href="#preguntas"><i class="ion-android-arrow-dropup-circle"></i></a>
				</h2>
				<p class="margin_bottom_30">
					Nos encargamos de que lleguen a tu hogar ya sea cualquier tipo de cerveza arteanal, para lo que gustan de esta maravillosa bebida, como así también equipamiento e ingredientes para fabricantes.
				</p>

				<h2 id="servicios" class="h2_faq">
					Ofrecen servicios para eventos?
					<a href="#preguntas"><i class="ion-android-arrow-dropup-circle"></i></a>
				</h2>
				<p class="margin_bottom_30">
					Si, podés contratarnos para que asistamos a tu fiesta o evento, ya sea con nuestro servicio de barra libre, o bien con entrega de tanques de cerveza de 10, 20 y 30 litros.
				</p>

				<h2 id="pagos" class="h2_faq">
					Cuáles son las formas de pago?
					<a href="#preguntas"><i class="ion-android-arrow-dropup-circle"></i></a>
				</h2>
				<p class="margin_bottom_30">
					Aceptamos pago en efectivo, transferencia bancaria, y todas las tarjetas de créditro a través de Mercadopago 
				</p>

				<h2 id="terminos" class="h2_faq">
					Cuáles son los términos y condiciones del sitio?
					<a href="#preguntas"><i class="ion-android-arrow-dropup-circle"></i></a>
				</h2>
				<p>
					Lorem ipsum dolor sit amet, consecteturbr <br>  adipisicing elit. Labore expedita eos, error quaerat obcaecati est deleniti magnam soluta recusandae ad nobis illo voluptas cumque dolorum nihil officiis, nam velit vitae!
				</p>
				<p>
					Lorem ipsum dolor sitbr <br>  amet, consectetur adipisicing elit. Labore expedita eos, error quaerat obcaecati est br <br> deleniti magnam soluta recusandae ad nobis illo voluptas cumque dolorum nihil officiis, nam velit vitae!
				</p>
				<p class="margin_bottom_30">
					Lorem ipsum dolor sitbr <br>  amet, consectetur adipisicing elit. Labore expedita eos, error quaerat obcaecati est deleniti magnam soluta recusandae ad nobis illo voluptas cumque br <br> dolorum nihil officiis, nam velit vitae!
				</p>

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