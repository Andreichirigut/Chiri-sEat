<?php
session_name("ChirisEat");
session_start();
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

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chiri'sEat</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilosPlatos.css">
		<script src="jq/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="https://kit.fontawesome.com/f6808f6c04.js" crossorigin="anonymous"></script>

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
			<li><a href="index.php"><i class="fas fa-home"></i><span> Inicio</span></a></li>
			<li><a href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a href="restaurantesSinSesion.php"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
		</nav>
		

			<?php
				$obj=consumir_servicio_REST($ruta."plato/id_plato/".urlencode($_SESSION["plato"]), "GET");
				if(isset($obj->mensaje_error)){
					die($obj->mensaje_error);
				}elseif (isset($obj->mensaje)) {
					echo "<p>".$obj->mensaje."</p>";
				}else{					

						echo "<section>";

						echo "<h1>".$obj->plato->nombre."</h1>";
						$numVotos = $obj->plato->votos;
						echo "<h4>";
							for ($i=0; $i < $numVotos; $i++) { 
								echo "<i class='fas fa-star'></i>";
							}
						echo "</h4>";	

							echo "<p id='foto'><img src='img/".$obj->plato->foto."'></img></p>";
							echo "<p id='descripcion'><strong>".$obj->plato->descripcion."</strong></p>";
							echo "<p id='receta'>".$obj->plato->receta."</p>";

							echo "<h3>Comentarios</h3>";
							$obj2=consumir_servicio_REST($ruta."comentario/id_plato/".urlencode($_SESSION["plato"]), "GET");
								if(isset($obj2->mensaje_error)){
									die($obj2->mensaje_error);
								}elseif (isset($obj2->mensaje)) {
									echo "<p>".$obj2->mensaje."</p>";
								}else{	
									foreach($obj2->comentarios as $fila){
																				
										$obj3=consumir_servicio_REST($ruta."usuario/id_usuario/".urlencode($fila->id_usuario), "GET");
										if(isset($obj3->mensaje_error)){
											die($obj3->mensaje_error);
										}elseif (isset($obj3->mensaje)) {
											echo "<p>".$obj3->mensaje."</p>";
										}else{
											echo "<p id='usuario'>".$obj3->usuario->usuario."</p>";
											$obj4=consumir_servicio_REST($ruta."comentarioConcreto/id_plato/".urlencode($fila->id_plato), "GET");
											if(isset($obj4->mensaje_error)){
												die($obj4->mensaje_error);
											}elseif (isset($obj4->mensaje)) {
												echo "<p>".$obj4->mensaje."</p>";
											}else{
												echo "<p id='comentario'>".$fila->comentario."</p>";
											}	
										}
									}
							
								}

						echo "</section>";

					
	
				}
			?>

		

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
