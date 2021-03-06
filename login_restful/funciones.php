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

    function obtener_platosTop(){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from platos ORDER BY votos desc";
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

    function obtener_platosRestaurantes($valor){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from platos where id_usuario = ".$valor."";
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

    function obtener_usuariosRestaurantes(){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from usuarios where tipo = 'restaurante'";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                $usuarios=Array();
                while($fila=mysqli_fetch_assoc($resultado)){
                    $usuarios[]=$fila;
                }
                mysqli_free_result($resultado);
                mysqli_close($con);
                return array("usuarios"=>$usuarios);
            }
        }
    }

    function obtener_comentarios(){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from comentarios";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                $comentarios=Array();
                while($fila=mysqli_fetch_assoc($resultado)){
                    $comentarios[]=$fila;
                }
                mysqli_free_result($resultado);
                mysqli_close($con);
                return array("comentarios"=>$comentarios);
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

    function obtener_comentarioConcreto($columna, $valor){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from comentarios where ".$columna."='".$valor."'";
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
                    return array("comentario"=>$fila);
                }else{
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                    return array("mensaje"=>"");
                }
                
        
            }
        }
    }
    

    function obtener_comentario($columna, $valor){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from comentarios where ".$columna."='".$valor."'";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                $comentarios=Array();
                while($fila=mysqli_fetch_assoc($resultado)){
                    $comentarios[]=$fila;
                }
                mysqli_free_result($resultado);
                mysqli_close($con);
                return array("comentarios"=>$comentarios);
            }
        }
    }

    function obtener_usuario($columna, $valor){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="select * from usuarios where ".$columna."='".$valor."'";
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
                    return array("mensaje"=>"No existe el usuario");
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

    function insertar_usuario($usuario,$clave,$email,$tipo){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="insert into usuarios(usuario, clave, email, tipo) VALUES('".$usuario."', '".md5($clave)."', '".$email."', '".$tipo."')";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha insertado el usuario : ".$titulo);
                
                
        
            }
        }
    }

    function insertar_comentario($usuario,$plato,$comentario){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="insert into comentarios(id_usuario, id_plato, comentario) VALUES('".$usuario."', '".$plato."', '".$comentario."')";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha insertado el comentario");
                
                
        
            }
        }
    }

    function insertar_plato($nombre,$descripcion,$foto,$receta,$usuario){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="insert into platos(nombre, descripcion, foto, receta, id_usuario) VALUES('".$nombre."', '".$descripcion."', '".$foto."', '".$receta."', '".$usuario."')";
            $resultado=mysqli_query($con, $consulta);
            if(!$resultado){
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha insertado el plato");
                
                
        
            }
        }
    }


    function sumar_voto($plato){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="update platos set votos=votos+1 where id_plato='".$plato."'";
            $resultado=mysqli_query($con, $consulta);
            if (!$resultado) {
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha actualizado");
            }
        }
    }

    function restar_voto($plato){
        $con=conectar();
        if(!$con){
            return array("mensaje_error"=>"Imposible conectar. Error ".mysqli_connect_errno());
        }else{
            mysqli_set_charset($con, "utf8");
            $consulta="update platos set votos=votos-1 where id_plato='".$plato."'";
            $resultado=mysqli_query($con, $consulta);
            if (!$resultado) {
                $mensaje="Imposible realizar la consulta. Error ".mysqli_errno($con);
                mysqli_close($con);
                return array("mensaje_error"=>$mensaje);
            }else{
                mysqli_close($con);
                return array("mensaje"=>"Se ha actualizado");
            }
        }
    }

    /*function borrar_libro($referencia){ 
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
    }*/

    

    

?>