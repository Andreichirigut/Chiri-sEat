

<?php

	

	$ruta="http://localhost/Proyectos/ChirisEat/login_restful/";

	
	if(isset($_POST["volver"])){
		session_unset();
		header("Location:index.php");
		exit;
	}

	
	if(isset($_POST["btPlato"])){
		$_SESSION["plato"]=$_POST["btPlato"];
		header("Location: platos.php");
		exit;
		
	}	
	
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilos4.css">
		<script src="jq/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="https://kit.fontawesome.com/f6808f6c04.js" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>	
	
	<script>
			$(document).ready(function () {
			var desplegado = false;
			$('#ham').click(function () {
				if ($(window).width() < 700) {
					if (desplegado == false) {
						$('#nav1').animate({ 'left': '+=350px' });

						desplegado = true;
					} else {
						$('#nav1').animate({ 'left': '-=350px' });

						desplegado = false;
					}
				}else{
					if (desplegado == false) {
						$('#nav1').animate({ 'left': '+=550px' });

						desplegado = true;
					} else {
						$('#nav1').animate({ 'left': '-=550px' });

						desplegado = false;
					}
				}
			});

			$('#ham2').click(function () {
				if ($(window).width() < 700) {
					if (desplegado == false) {
						$('#nav2').animate({ 'left': '-=750px' });

						desplegado = true;
					} else {
						$('#nav2').animate({ 'left': '+=750px' });

						desplegado = false;
					}
				}else{
					if (desplegado == false) {
						$('#nav2').animate({ 'left': '-=1000px' });

						desplegado = true;
					} else {
						$('#nav2').animate({ 'left': '+=1000px' });

						desplegado = false;
					}
				}
			});
			
		});
		</script>

		<script>
			$(document).ready(function(){
			$('.slider').bxSlider();
			});
		</script>

		<title>Ejer2</title>
		

	</head>
	<body>
	<div id="head">
		<label for="hamburguesa" id="ham">
			<span>&#x2630;</span>
		</label>
			<h1>Chiri'sEat</h1>
		<label for="hamburguesa2" id="ham2">
			<span><i class="fas fa-user"></i></span>
		</label>	
		
		<?php
			/*if(isset($_SESSION["restringida"])){
				echo "<p> ¡¡¡ Está usted tratando de acceder a una zona restringida. Por favor logueese o registrese. !!! </p>";
			}
			if(isset($_SESSION["tiempo"])){
				echo "<p> ¡¡¡ Tiempo de sesión sobrepasado. Por favor logueese o registrese. !!! </p>";
			}
			session_unset();*/	
		?>
		</div>

		<nav id="nav1">
			<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a href="vista_restaurante.php"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a id="comunidad" href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
			<li>
			<form action="index.php" method="post">
				<button type="submit" name="volver"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</button>
			</form>
			</li>
		</nav>


		<nav id="nav2">
			<li><a id="platos" href="#"><i class="fas fa-users"></i><span> Subir Platos</span></a>
			<li><a id="misPlatos" href="#"><i class="fas fa-utensils"></i><span> Mis platos</span></a>
			<li>
			<form action="index.php" method="post">
				<button type="submit" name="volver"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</button>
			</form>
			</li>
		</nav>

		<div class="slider">
			<div><img src="img/slider.jpg"></img></div>
			<div><img src="img/slider2.jpg"></img></div>
			<div><img src="img/slider3.jpg"></img></div>
  		</div>

		<main>

		<?php 
						$obj=consumir_servicio_REST($ruta."platos", "GET");
						if (isset($obj->mensaje_error)) {
							die($obj->mensaje_error);
						}else {
							foreach($obj->platos as $fila){
								echo "<section>";
									echo "<div id='img'>";
										echo "<img src='img/".$fila->foto."'></img>";
									echo "</div>";

									echo "<div id='text'>";
										echo "<form action='index.php' method='post'>";
										echo "<button type='submit' value='".$fila->id_plato."' name='btPlato'><h2>".$fila->nombre."</h2></button>";
										echo "</form>";
										echo "<p>".$fila->descripcion."</p>";
									echo "</div>";

								echo "</section>";	
							}
						}
		?>

			
			
		</main>

		<footer>
				<div id="footer1">
						<h1>Chiri'sEat</h1>
						<p>Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o de borradores de diseño para probar el diseño visual antes de insertar el texto final</p>
						<p><i class="fab fa-facebook-square"></i><i class="fab fa-instagram-square"></i><i class="fab fa-twitter-square"></i></p>
				</div>

				<div id="footer2">
						<h3>Concactanos</h3>
						
						<p>prueba@gmail.com</p>
						<p>666999666</p>
						<p>999666999</p>
						
				</div>
		</footer>
				

				

		
			

	</body>

</html>

