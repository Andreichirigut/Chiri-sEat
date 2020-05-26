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

if(isset($_POST["btnRegistro"])){
   
    
    	if($_POST["usuario"]=="")
           $errorUsuario=" * Campo Vacío * "; 
    
    	if($_POST["clave1"]=="")
			$errorClave1=" * Campo Vacío * ";

		if($_POST["clave2"]=="")
			$errorClave2=" * Campo Vacío * ";	
			
		if($_POST["email"]=="")
            $errorEmail=" * Campo Vacío * ";
	
		if($_POST["clave1"]!=$_POST["clave2"]){
			$errorClave=" * La clave no coincide * ";
		}	

	if(!isset($errorUsuario) && !isset($errorClave1) && !isset($errorClave2) && !isset($errorEmail) && !isset($errorClave)){

		

			$datos_usuario["usuario"]=$_POST["usuario"];
			$datos_usuario["clave"]=$_POST["clave1"];
			$datos_usuario["email"]=$_POST["email"];
			$datos_usuario["tipo"]=$_POST["tipo"];
			$obj=consumir_servicio_REST($ruta."insertarUsuario", "POST", $datos_usuario);
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
		<link rel="stylesheet" href="css/estilosRegistro.css">
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
			<li><a href="index.php"><i class="fas fa-user"></i><span> Inicio</span></a></li>
			<li><a href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a href="#"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
		</nav>

		<div class="slider">
			<div><img src="img/slider.jpg"></img></div>
			<div><img src="img/slider2.jpg"></img></div>
			<div><img src="img/slider3.jpg"></img></div>
  		</div>

		<div id="login">
			<h1>Registrarse</h1>
		<form method="post" action="registro_usuario.php">
			<div id="campos">
				
					<label for="usuario">Usuario:</label>
					<input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
					
					<?php
						if(isset($errorUsuario))
							echo $errorUsuario;
					
					?>
					
			
				
					<label for="clave1">Contraseña:</label>
					<input type="password" id="clave1" name="clave1" value=""/>
					
					<?php
						if(isset($errorClave1))
							echo $errorClave1;

						
					?>

					<label for="clave2">Repita la contraseña:</label>
					<input type="password" id="clave2" name="clave2" value=""/>
					
					<?php
						if(isset($errorClave2))
							echo $errorClave2;

						if(isset($errorClave))
							echo $errorClave;
					?>

					<label for="email">Correo:</label>
					<input type="email" id="email" name="email" value=""/>
					
					<?php
						if(isset($errorEmail))
							echo $errorEmail;

						
					?>

				<label for="tipo">Tipo:</label>
				<select id="tipo" name="tipo">
					<option value="normal">Normal</option>
					<option value="restaurante">Restaurante</option>
				</select>
							
				
		</div>
		<div id="botones">
			<button type="submit" name="btnRegistro" id="boton1"><span><i class="fas fa-arrow-circle-right"></span></i></button>
			<button type="submit" name="btnInicarSesion" id="botonReg" formaction="login.php">Iniciar Sesion</button>
		</div>
		</form>

		</div>

		

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
