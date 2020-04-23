<?php
session_name("ChirisEat");
session_start();

require "funciones_y_ctes.php";

if(isset($_SESSION["usuario"]) && isset($_SESSION["clave"]) && isset($_SESSION["ultimo_acceso"])){

	if($datos_user=obtener_usuario($_SESSION["usuario"], $_SESSION["clave"])){

		
			if($datos_user["tipo"]=="usuario"){
				$_SESSION["ultimo_acceso"]=time();
				include "vista_normal.php";
			}else if($datos_user["tipo"]=="restaurante"){
				$_SESSION["ultimo_acceso"]=time();
				include "vista_restaurante.php";
			}
		

	}else{
		session_unset();
		$_SESSION["restringida"]="";
		header("Location:index.php");
	}
}else{
	include "vista_principal.php";
}
?>
	

