<?php
    require "conexion_bd.php";
    function obtener_platos(){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from platos";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                $platos=Array();
                while($fila=mysqli_fetch_assoc($resultado)){
                    $platos[]=$fila;
                }
                mysqli_free_result($resultado);
                mysqli_close($con);
                return array("platos"=>$platos);
            }
        }
    }

    function obtener_plato($columna, $valor){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from platos where ".$columna."='".$valor."'";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                if(mysqli_num_rows($resultado)>0){
                    $fila=mysqli_fetch_assoc($resultado);
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                    return array("plato"=>$fila);
                }else{
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                    return array("mensaje"=>"No existe el plato con ".$columna." igual a ".$valor);
                }
                
        
            }
        }
    }

    function login_usuario($usuario, $clave){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from usuarios where usuario='".$usuario."' and clave='".$clave."'";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                if(mysqli_num_rows($resultado)>0){
                    $fila=mysqli_fetch_assoc($resultado);
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                    return array("usuario"=>$fila);
                }else{
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                    return array("mensaje"=>"No existe el usuario ".$usuario);
                }
                
        
            }
        }
    }

    function insertar_libro($titulo,$autor,$descripcion,$precio){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="insert into libros(titulo, autor, descripcion, precio) VALUES('".$titulo."', '".$autor."', '".$descripcion."', '".$precio."')";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha insertado el libro : ".$titulo);
                
                
        
            }
        }
    }

    function borrar_libro($referencia){ 
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="delete from libros where referencia='".$referencia."'";
            $resultado=mysqli_query($con, $consulta);
            if (!$resultado) {
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha borrado el libro con id: ".$referencia);
            }
        }    
    }

    function actualizar_libro($referencia,$titulo,$autor,$descripcion,$precio){
        return "adios";
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="update libros set titulo='".$titulo."', autor='".$autor."', descripcion='".$descripcion."', precio='".$precio."' where referencia='".$referencia."'";
            $resultado=mysqli_query($con, $consulta);
            return "hola";
            if (!$resultado) {
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha actualizado el libro con titulo : ".$titulo);
            }
        }
    }

    

    

?>