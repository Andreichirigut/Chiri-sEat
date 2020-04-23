<?php
define('MINUTOS',10);

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
//Devuelve array con los datos del usuario o false

function obtener_usuario($usuario, $clave){
    $datosPost=['usuario'=>$usuario, 'clave'=>$clave];
    $obj=consumir_servicio_REST("http://localhost/Proyectos/ChirisEat/login_restful/login", "POST", $datosPost);

    if(isset($obj->mensaje_error)){
        die($obj->mensaje_error);
    }else if(isset($obj->mensaje)){
        return false;
    }else{
        $datos["id_usuario"]=$obj->usuario->id_usuario;
        $datos["usuario"]=$obj->usuario->usuario;
        $datos["tipo"]=$obj->usuario->tipo;
        $datos["clave"]=$obj->usuario->clave;
        return $datos;
    }
}





?>
