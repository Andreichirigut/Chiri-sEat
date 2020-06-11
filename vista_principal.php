<?php

$ruta="http://localhost/Proyectos/ChirisEat/login_restful/";

if(isset($_POST["btnEntrar"])){
   
    
    	if($_POST["usuario"]=="")
           $errorUsuario=" * Campo Vacío * ";
        
    
    	if($_POST["clave"]=="")
            $errorClave=" * Campo Vacío * ";
    

	if(!isset($errorUsuario) && !isset($errorClave)){
    		if($datos_usu_log=obtener_usuario($_POST["usuario"],MD5($_POST["clave"]))){
				$_SESSION["usuario"]=$_POST["usuario"];
				$_SESSION["clave"]=MD5($_POST["clave"]);
				$_SESSION["ultimo_acceso"]=time();
				header("Location: index.php");
				exit;
    		}
    		else
            		$errorUsuario=" * Login incorrecto: Vuelva a intentarlo * ";
 
	}
       
}

if(isset($_POST["btPlato"])){
	$_SESSION["plato"]=$_POST["btPlato"];
	header("Location: platosSinSesion.php");
	exit;
	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chiri'sEat</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilos.css">
		<script src="jq/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="https://kit.fontawesome.com/f6808f6c04.js" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>	
	
		<script>
			$(document).ready(function () {
			var desplegado = false;
			$('label').click(function () {
				if ($(window).width() < 700) {
					if (desplegado == false) {
						$('nav').animate({ 'left': '+=50vw' });

						desplegado = true;
					} else {
						$('nav').animate({ 'left': '-=50vw' });

						desplegado = false;
					}
				}else{
					if (desplegado == false) {
						$('nav').animate({ 'left': '+=50vw' });

						desplegado = true;
					} else {
						$('nav').animate({ 'left': '-=50vw' });

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

	</head>
	<body>
		
		<div id="head">
		<label for="hamburguesa">
			<span>&#x2630;</span>
		</label>
			<h1>Chiri'sEat</h1>
		
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

		<nav>
			<li><a href="login.php"><i class="fas fa-user"></i><span> Iniciar sesión</span></a></li>
			<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a href="restaurantesSinSesion.php"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a href="top.php"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
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
										echo "<p>".$fila->descripcion."</p>";
										echo "</form>";
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
