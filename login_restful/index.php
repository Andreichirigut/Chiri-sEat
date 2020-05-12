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
$app->get('/comentarios', function () {
	echo json_encode(obtener_comentarios(), JSON_FORCE_OBJECT);
});

$app->get('/plato/:columna/:valor', function ($columna, $valor) {
	echo json_encode(obtener_plato($columna, $valor), JSON_FORCE_OBJECT);
});



$app->post('/login', function () {
	echo json_encode(login_usuario($_POST["usuario"], $_POST["clave"]), JSON_FORCE_OBJECT);
});

$app->post('/insertarLibro', function () {
	echo json_encode(insertar_libro($_POST["titulo"],$_POST["autor"],$_POST["descripcion"],$_POST["precio"]), JSON_FORCE_OBJECT);
});

$app->put('/actualizarLibro/:referencia', function ($refrencia) use($app) {
	$datos_libros=$app->request->put();
	echo json_encode(actualizar_libro($referencia,$datos_libros["titulo"],$datos_libros["autor"],$datos_libros["descripcion"],$datos_libros["precio"]), JSON_FORCE_OBJECT);
});

$app->delete('/borrarLibro/:refrencia', function ($referencia){
	echo json_encode(borrar_libro($referencia), JSON_FORCE_OBJECT);
});


// Ejecutamos la aplicación creada
$app->run();
?>
