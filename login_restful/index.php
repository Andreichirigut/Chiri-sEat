<?php
require 'Slim/Slim.php';
require "funciones.php";
// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();
// Creamos la aplicación
$app = new \Slim\Slim();
// Indicamos el tipo de contenido y condificación que devolveremos desde el framework Slim
$app->contentType('application/json; charset=utf-8');





// Definimos las respuesta de la ruta base con un tipo de consulta GET
$app->get('/platos', function () {
	echo json_encode(obtener_platos(), JSON_FORCE_OBJECT);
});
$app->get('/platosCorespondientes/:valor', function ($valor) {
	echo json_encode(obtener_platosRestaurantes($valor), JSON_FORCE_OBJECT);
});
$app->get('/usuariosRestaurantes', function () {
	echo json_encode(obtener_usuariosRestaurantes(), JSON_FORCE_OBJECT);
});
$app->get('/comentarios', function () {
	echo json_encode(obtener_comentarios(), JSON_FORCE_OBJECT);
});

$app->get('/plato/:columna/:valor', function ($columna, $valor) {
	echo json_encode(obtener_plato($columna, $valor), JSON_FORCE_OBJECT);
});

$app->get('/comentario/:columna/:valor', function ($columna, $valor) {
	echo json_encode(obtener_comentario($columna, $valor), JSON_FORCE_OBJECT);
});
$app->get('/comentarioConcreto/:columna/:valor', function ($columna, $valor) {
	echo json_encode(obtener_comentarioConcreto($columna, $valor), JSON_FORCE_OBJECT);
});
$app->get('/usuario/:columna/:valor', function ($columna, $valor) {
	echo json_encode(obtener_usuario($columna, $valor), JSON_FORCE_OBJECT);
});

$app->post('/login', function () {
	echo json_encode(login_usuario($_POST["usuario"], $_POST["clave"]), JSON_FORCE_OBJECT);
});

$app->post('/insertarUsuario', function () {
	echo json_encode(insertar_usuario($_POST["usuario"],$_POST["clave"],$_POST["email"],$_POST["tipo"]), JSON_FORCE_OBJECT);
});
$app->post('/insertarComentario', function () {
	echo json_encode(insertar_comentario($_POST["usuario"],$_POST["plato"],$_POST["comentario"]), JSON_FORCE_OBJECT);
});
$app->post('/insertarPlato', function () {
	echo json_encode(insertar_plato($_POST["nombre"],$_POST["descripcion"],$_POST["foto"],$_POST["receta"], $_POST["usuario"]), JSON_FORCE_OBJECT);
});

$app->post('/sumarVoto', function () {
	echo json_encode(sumar_voto($_POST["plato"]), JSON_FORCE_OBJECT);
});
$app->post('/restarVoto', function () {
	echo json_encode(restar_voto($_POST["plato"]), JSON_FORCE_OBJECT);
});

/*$app->put('/actualizarLibro/:referencia', function ($refrencia) use($app) {
	$datos_libros=$app->request->put();
	echo json_encode(actualizar_libro($referencia,$datos_libros["titulo"],$datos_libros["autor"],$datos_libros["descripcion"],$datos_libros["precio"]), JSON_FORCE_OBJECT);
});

$app->delete('/borrarLibro/:refrencia', function ($referencia){
	echo json_encode(borrar_libro($referencia), JSON_FORCE_OBJECT);
});*/


// Ejecutamos la aplicación creada
$app->run();
?>
