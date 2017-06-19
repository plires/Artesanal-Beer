<?php

/* Include Funciones */
include_once('soporte.php');

?>

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
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "home"; ?>
	
	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!--Include SLIDE HOME-->
	<?php include_once('includes/slide.php'); ?>

	<!--Container start-->
	<div class="container">

		<!--Sub - container Start-->
		<div class="sub_container">

			<h1 class="text_center titulo_h1">Cerveza Artesanal</h1>
			<hr>
			<h2>Vos la haces, te ayudamos a venderla</h2>

			<p>
			Somos un grupo de personas amantes de la buena cerveza artesanal.
			</p>

			<p>
			Concientes del numeroso crecimiento de productores de cervezas artenalales y caseras que chocaban contra la falta de contactos para venderla, o la falta de logística para entregarla fue que decidimos implementar una plataforma de comercio electronico para que puedas vender, cobrar y entregar tu cerveza.
			</p>
			
			<h3 class="h3_home">
				Por eso te proponemos que hagas lo que mas te gusta y mejor te sale, hacer cerveza...de lo aburrido nos encargamos nosotros y nuestra plataforma."
			</h3>

			<hr class="margin_bottom_30">

		</div>
		<!--Sub - container end-->

		<!--Productos start-->
		<section class="main_products">

			<article class="item animated fadeInDown">
				<a href="#"><img src="images/product-1.jpg" alt="product 1"></a>
				<div class="item_descuento boton_gris">
					20 % OFF
				</div>
				<h2>Cerveza Rubia Intensa con alto contenido de lúpulo</h2>
				<p title="Aroma, color y cuerpo intenso. Alto contenido de lúpulo y con malta seleccionada." >
					Aroma, color y cuerpo intenso. Alto contenido de lúpulo y con malta seleccionada.
				</p>
				<span class="precio">$80</span>
				<a href="#" class="boton_carrito boton_amarillo fadeIn">Agregar</a>
			</article>

			<article class="item animated fadeInUp">
				<a href="#"><img src="images/product-2.jpg" alt="product 2"></a>
				<h2>Cerveza Rubia Suave</h2>
				<p title="Honey beer.">Honey beer.</p>
				<span class="precio">$75</span>
				<a href="#" class="boton_carrito boton_amarillo">Agregar</a>
			</article>

			<article class="item animated fadeInDown">
				<a href="#"><img src="images/product-3.jpg" alt="product 3"></a>
				<div class="item_descuento boton_gris">
					8 % OFF
				</div>
				<h2>Cerveza Roja IPA</h2>
				<p title="Bajo contenido de lúpulo.">Bajo contenido de lúpulo.</p>
				<span class="precio">$120</span>
				<a href="#" class="boton_carrito boton_amarillo">Agregar</a>
			</article>

			<article class="item animated fadeInDown">
				<a href="#"><img src="images/product-4.jpg" alt="product 4"></a>
				<div class="item_descuento boton_gris">
					15 % OFF
				</div>
				<h2>Set para regalo</h2>
				<p title="Roja, Rubia y negra.">Roja, Rubia y negra.</p>
				<span class="precio">$310</span>
				<a href="#" class="boton_carrito boton_amarillo">Agregar</a>
			</article>

			<article class="item animated fadeInUp">
				<a href="#"><img src="images/product-5.jpg" alt="product 5"></a>
				<h2>Botellón 600 cm3.</h2>
				<p title="Kit fundamental.">Kit fundamental.</p>
				<span class="precio">$270</span>
				<a href="#" class="boton_carrito boton_amarillo">Agregar</a>
			</article>

			<article class="item animated fadeInDown">
				<a href="#"><img src="images/product-6.jpg" alt="product 6"></a>
				<div class="item_descuento boton_gris">
					5 % OFF
				</div>
				<h2>Cerveza Artesanal.</h2>
				<p title="Caracter y sabor.">Caracter y sabor.</p>
				<span class="precio">$80</span>
				<a href="#" class="boton_carrito boton_amarillo">Agregar</a>
			</article>

		</section>
		<!--Productos end-->
		
	</div>
	<!--Container end-->

	<!--Section fondo de color de ancho al 100% start-->
	<section class="fondo_color_principal">

		<!--Container start-->
		<div class="container">

			<div class="section_promocion_izq color_secundario">
				<h3>DURANTE TODO EL MES <br>Promociónes de cerveza NEGRA</h3>
			</div>
			<div class="section_promocion_der">
				<a href="#" class="btn boton_gris">Ver más<i class="ion-arrow-right-c"></i></a>
			</div>

		</div>
		<!--Container end-->
	</section>
	<!--Section fondo de color de ancho al 100% end-->



	<!--Section Avatar de usuarios start-->
	<section class="section_avatar">

		<!--Container start-->
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">

				<h4 class="text_center">Ellos confian en nuestra plataforma. Sumate vos también con tu cerveza!</h4>
				<hr>
				<p class="avatar_titulo_comentarios">
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat vomy nibh euismod tincidunt ut laoreet dolore magn.
				</p>

			</div>
			<!--Sub - container end-->


			<article class="avatar_usuario">
				<a href="#"><img src="images/usuario-1.jpg" alt="usuario 1"></a>
				<h4>Carlos Vazquez</h4>
				<hr>
				<p>La plataforma de "Artesanal Beer" me ayudo muchisimo, solo tengo que producir!</p>
			</article>

			<article class="avatar_usuario">
				<a href="#"><img src="images/usuario-2.jpg" alt="usuario 2"></a>
				<h4>Brenda Schik</h4>
				<hr>
				<p>Los costos que maneja la plataforma son muy razonables. Hace solo 5 meses que la uso!</p>
			</article>
			<span style="clear: both;"></span>

			<article class="avatar_usuario">
				<a href="#"><img src="images/usuario-3.jpg" alt="usuario 3"></a>
				<h4>Jose Perez</h4>
				<hr>
				<p>Con la plataforma pude ofrecer a mis clientes la posibilidad de pagar con credito y debito!</p>
			</article>

			<article class="avatar_usuario">
				<a href="#"><img src="images/usuario-4.jpg" alt="usuario 4"></a>
				<h4>Juan Pest</h4>
				<hr>
				<p>Producia mi cerveza pero no contaba con logistica. La plataforma de Artesanal Beer lo soluciono!</p>
			</article>

		</div>
		<!--Container end-->

	</section>
	<!--Section Avatar de usuarios end-->


	<!--Section Categorias destacadas de usuarios start-->
	<section class="section_categorias_destacadas">

		<!--Container start-->		
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">
				<h2 class="text_center">Categorias Destacadas</h2>
				<hr>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente cupiditate sint earum cum cumque, veniam fugit dolore, deserunt neque ratione quaerat enim fuga, quibusdam repellat assumenda vel a modi eligendi.
				</p>			
			</div>			
			<!--Sub - container End-->

			<a href="#"><article class="text_center">
				<img src="images/category-cursos.jpg" alt="category 1">
				<div class="container_texto_categorias">
					<h3>Cursos de Elaboración</h3>
					<hr class="linea_blanca">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</p>
				</div>
			</article>
			</a>

			<a href="#"><article class="text_center">
				<img src="images/category-negra.jpg " alt="category 2">
				<div class="container_texto_categorias">
					<h3>Cervezas Negras</h3>
					<hr class="linea_blanca">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</p>
				</div>
			</article>
			</a>

			<a href="#"><article class="text_center">
				<img src="images/category-roja.jpg" alt="category 3">
				<div class="container_texto_categorias">
					<h3>Cervezas Rojas</h3>
					<hr class="linea_blanca">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</p>
				</div>
			</article>
			</a>

			<a href="#"><article class="text_center">
				<img src="images/category-rubia.jpg" alt="category 4">
				<div class="container_texto_categorias">
					<h3>Cervezas Rubias</h3>
					<hr class="linea_blanca">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					</p>
				</div>
			</article>
			</a>


		</div>
		<!--Container end-->

	</section>
	<!--Section Categorias destacadas de usuarios end-->



	<!--Section caracteristicas del servicio start-->
	<section class="section_caracteristicas">

		<!--Fondo negro opacity start-->
		<div class="fondo_negro_opacity color_blanco">

		<!--Container start-->
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">
			
				<article class="text_center">
					<img src="images/premium.png" alt="premium">
					<h4>Productos Premium &amp; <br>Calidad Garantizada.</h4>
					<hr class="linea_blanca">
					<p>Lorem ipsum dolor sit amet,consectetuer adipiscing elit, Lorem ipsum dolor</p>
					<a href="#">Leer más >></a>
				</article>

				<article class="text_center">
					<img src="images/cupon.png" alt="cupon">
					<h4>Cupones de <br>Descuento.</h4>
					<hr class="linea_blanca">
					<p>Lorem ipsum dolor sit amet,consectetuer adipiscing elit, Lorem ipsum dolor</p>
					<a href="#">Leer más >></a>
				</article>

				<article class="text_center">
					<img src="images/especiales.png" alt="especiales">
					<h4>Consulte por <br>Tipos Especiales.</h4>
					<hr class="linea_blanca">
					<p>Lorem ipsum dolor sit amet,consectetuer adipiscing elit, Lorem ipsum dolor</p>
					<a href="#">Leer más >></a>
				</article>

				<article class="text_center">
					<img src="images/24.png" alt="24">
					<h4>Contactanos <br>las 24 horas.</h4>
					<hr class="linea_blanca">
					<p>Lorem ipsum dolor sit amet,consectetuer adipiscing elit, Lorem ipsum dolor</p>
					<a href="#">Leer más >></a>
				</article>
			

				<!--NEWSLETTER start-->
				<div class="newsletter text_center">
					<h5>SUSCRIBITE <span class="tipo_ligth">A NUESTRO NEWSLETTER</span></h5>	
					<p>
						Enterate de las últimas novedades y tendencias sobre la cerveza artesanal.
					</p>
					<hr>
					<form action="" method="post">
						<input class="newsletter_input" name="email" type="email" placeholder="Email">
						<input class="newsletter_enviar" name="enviar" type="submit" value="Enviar">
					</form>
				</div>
				<!--NEWSLETTER end-->

			</div>
			<!--Sub - container end-->


		</div>
		<!--Container end-->

		</div>
		<!--Fondo negro opacity end-->

	</section>
	<!--Section caracteristicas del servicio end-->

	<!--Include FOOTER-->
	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	
</body>
</html>