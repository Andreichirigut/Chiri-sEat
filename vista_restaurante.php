

<?php

	

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
		<meta charset="UTF-8"/>
		<title>Ejer2</title>
		<style>
			button{border:none; color:black;background-color:white;}
			button:hover{color:blue;cursor:pointer;}
		</style>

	</head>
	<body>
		
	<form action="index.php" method="post">
			<button type="submit" name="volver">Volver</button>
	</form>
			

	</body>

</html>

