

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
						$('#nav2').animate({ 'left': '-=950px' });

						desplegado = true;
					} else {
						$('#nav2').animate({ 'left': '+=950px' });

						desplegado = false;
					}
				}
			});
			
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
			<span>&#x2630;</span>
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
			<li>
			<form action="index.php" method="post">
				<button type="submit" name="volver"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</button>
			</form>
			</li>
			<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a id="comunidad" href="#"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a id="comunidad" href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
		</nav>

		<nav id="nav2">
			<li>
			<form action="index.php" method="post">
				<button type="submit" name="volver"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</button>
			</form>
			</li>
			<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a id="comunidad" href="#"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a id="comunidad" href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
		</nav>

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

		</footer>
				

				

		
			

	</body>

</html>
