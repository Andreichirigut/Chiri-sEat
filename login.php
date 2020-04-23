<?php
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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chiri'sEat</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/estilos2.css">
		<script src="jq/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="https://kit.fontawesome.com/f6808f6c04.js" crossorigin="anonymous"></script>

		<script>
			$(document).ready(function () {
			var desplegado = false;
			$('label').click(function () {
				if ($(window).width() < 700) {
					if (desplegado == false) {
						$('nav').animate({ 'left': '+=350px' });

						desplegado = true;
					} else {
						$('nav').animate({ 'left': '-=350px' });

						desplegado = false;
					}
				}else{
					if (desplegado == false) {
						$('nav').animate({ 'left': '+=550px' });

						desplegado = true;
					} else {
						$('nav').animate({ 'left': '-=550px' });

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
			<li><a href="index.php"><i class="fas fa-user"></i><span> Inicio</span></a></li>
			<li><a href="#"><i class="fas fa-users"></i><span> Comunidad</span></a>
			<li><a href="#"><i class="fas fa-utensils"></i><span> Restaurantes</span></a>
			<li><a href="#"><i class="fas fa-star"></i><span> Lo mas Top</span></a>
		</nav>

		<div id="login">
			<h1>Iniciar Sesion</h1>
		<form method="post" action="index.php">
			<div id="campos">
				
					<label for="usuario">Usuario:</label>
					<input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
					
					<?php
						if(isset($errorUsuario))
							echo $errorUsuario;
					
					?>
					
			
				
					<label for="clave">Contraseña:</label>
					<input type="password" id="clave" name="clave" value=""/>
					
					<?php
						if(isset($errorClave))
							echo $errorClave;

						
					?>
							
				
		</div>
		<div id="botones">
			<button type="submit" name="btnEntrar" id="boton1"><span><i class="fas fa-arrow-circle-right"></span></i></button>
			<button type="submit" name="btnRegistrar" id="botonReg" formaction="registro_usuario.php">Registrarse</button>
		</div>
		</form>

		</div>

		

		<footer>

		</footer>
	</body>
</html>
