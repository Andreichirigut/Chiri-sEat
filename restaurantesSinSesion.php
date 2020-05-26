

<?php

function consumir_servicio_REST($url,$metodo,$datos=null)
{
       
        $llamada = curl_init(); 
        curl_setopt($llamada, CURLOPT_URL, $url); 
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if(isset($datos))
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    
        $response=curl_exec($llamada);
        curl_close($llamada);
        if(!$response) 
            die("Error consumiendo el servicio Web: ".$url);
    
        return json_decode($response);
}

	$ruta="http://localhost/Proyectos/ChirisEat/login_restful/";

	if(isset($_POST["volver"])){
		session_unset();
		header("Location:index.php");
		exit;
	}
	
?>



<!DOCTYPE html>
<html>
<head>
		<title>Chiri'sEat</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilosRestaurante.css">
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
				<li><a id="login.php" href="login.php"><<i class="fas fa-user"></i>Iniciar Sesion</a>
				<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
				<li><a href="index.php"><i class="fas fa-user"></i><span> Inicio</span></a>
				<li><a id="comunidad" href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
			</nav>
		

		

		<div class="slider">
			<div><img src="img/slider.jpg"></img></div>
			<div><img src="img/slider2.jpg"></img></div>
			<div><img src="img/slider3.jpg"></img></div>
  		</div>

		<main>

		<?php 
						$obj=consumir_servicio_REST($ruta."usuariosRestaurantes", "GET");
						
							if (isset($obj->mensaje_error)) {
								die($obj->mensaje_error);
							}else {
				
								foreach($obj->usuarios as $fila){
									echo "<div id='container'>";
									echo "<h1 id='usuario'>".$fila->usuario."</h1>";
									
									$obj2=consumir_servicio_REST($ruta."platosRestaurantes/".urlencode($fila->id_usuario), "GET");
									if (isset($obj2->mensaje_error)) {
										die($obj2->mensaje_error);
									}else {
										foreach($obj2->platos as $fila){
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
									echo "</div>";
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

