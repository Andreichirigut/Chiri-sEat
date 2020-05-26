

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

	if(isset($_POST["volver"])){
		session_unset();
		header("Location:index.php");
		exit;
	}
	
	if(isset($_POST["btnSubir"])){
   
    
    	if($_POST["nombre"]=="")
           $errorNombre=" * Campo Vacío * "; 
    
    	if($_POST["descripcion"]=="")
			$errorDescripcion=" * Campo Vacío * ";

		if($_POST["receta"]=="")
			$errorReceta=" * Campo Vacío * ";	
			

	if(!isset($errorNombre) && !isset($errorDescripcion) && !isset($errorReceta)){

			$obj3=consumir_servicio_REST($ruta."usuario/usuario/".urlencode($_SESSION["usuario"]), "GET");
				if(isset($obj3->mensaje_error)){
					die($obj3->mensaje_error);
				}elseif (isset($obj3->mensaje)) {
					echo "<p>".$obj3->mensaje."</p>";
				}else{	
					$usuario = $obj3->usuario->id_usuario;
				}

				$usuario = (int)$usuario;	

			$datos_platos["nombre"]=$_POST["nombre"];
			$datos_platos["descripcion"]=$_POST["descripcion"];
			$datos_platos["foto"]=$_FILES["foto"]["name"];
			$datos_platos["receta"]=$_POST["receta"];
			$datos_platos["usuario"]=$usuario;


			move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $_FILES['foto']['name']);

			$obj=consumir_servicio_REST($ruta."insertarPlato", "POST", $datos_platos);
			if(isset($obj->mensaje_error)){
				die($obj->mensaje_error);
			}else{
				header("Location: index.php");
				exit;
			}
       
	}
}
?>



<!DOCTYPE html>
<html>
<head>
		<title>Chiri'sEat</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilosSubir.css">
		<script src="jq/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="https://kit.fontawesome.com/f6808f6c04.js" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>	
	
		<script>
			$(document).ready(function () {
			var desplegado = false;
			$('#hamburguesa').click(function () {
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
		<label for="hamburguesa" id="hamburguesa">
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
				<li><a id="comunidad" href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
				<li><a href="restaurantesConSesion.php"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
				<li><a id="comunidad" href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
				<li><a id="inicio" href="index.php"><i class="fas fa-user"></i><span> Inicio</span></a>
				
			</nav>
		

		
		<div class="slider">
			<div><img src="img/slider.jpg"></img></div>
			<div><img src="img/slider2.jpg"></img></div>
			<div><img src="img/slider3.jpg"></img></div>
  		</div>
		

		<main>

			

			<form method="post" action="subirPlato.php" id="formulario" enctype="multipart/form-data">
			<div id="campos">
				
					<label for="nombre">Nombre:</label>
					<input type="text" id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
					
					<?php
						if(isset($errorNombre))
							echo $errorNombre;
					
					?>
					
			
				
					<label for="descripcion">Descripcion:</label>
					<textarea name='descripcion' rows='10' cols='195'></textarea>
					
					<?php
						if(isset($errorDescripcion))
							echo $errorDescripcion;

						
					?>

					<label for="foto">Foto:</label>
					<input name="foto" type="file" id="foto"/>


					<label for="receta">Receta:</label>
					<textarea name='receta' rows='10' cols='195'></textarea>
					
					<?php
						if(isset($errorReceta))
							echo $errorReceta;
					
					?>
							
				
		</div>
		<div id="botones">
			<button type="submit" name="btnSubir" id="boton1">Subir</button>
		</div>
		</form>

		

			
			
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

