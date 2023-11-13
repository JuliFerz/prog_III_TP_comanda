<?php
// Error Handling
error_reporting(-1);
error_reporting(E_ALL ^ E_DEPRECATED); // no mostrar codigo deprecado
ini_set('display_errors', 1);

// require_once 'vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../vendor/autoload.php';
require_once './db/AccesoDatos.php';
require_once './controllers/UsuarioController.php';
require_once './controllers/PedidoController.php';

$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

$app->get('[/]', function (Request $request, Response $response) {
    $response->getBody()->write(json_encode(['response' => 'OK']));
    return $response;
});

$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->get('[/]', \UsuarioController::class . ':TraerTodos');
    $group->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $group->post('[/]', \UsuarioController::class . ':CargarUno');
    $group->put('/{usuario}', \UsuarioController::class . ':ModificarUno');
    $group->delete('/{usuario}', \UsuarioController::class . ':BorrarUno');
});

$app->group('/pedidos', function (RouteCollectorProxy $group) {
    $group->get('[/]', \PedidoController::class . ':TraerTodos');
    $group->get('/{pedido}', \PedidoController::class . ':TraerUno');
    $group->post('[/]', \PedidoController::class . ':CargarUno');
    $group->put('/{pedido}', \PedidoController::class . ':ModificarUno');
    $group->delete('/{pedido}', \PedidoController::class . ':BorrarUno');
    /*
    CORREGIR:
        . Generar nueva tabla de "productos", donde por ahora tiene:
            "id"
            "nombre"
            "descripcion"
            "tipo"
            "precio"
            "stock"
            "estado"
            "fecha_modificacion"
            "fecha_baja"
        . Generar los nuevos datos de prueba (con la pagina) para esta tabla

        . Generar de nuevo la tabla de pedidos, pero con la columna de id_producto debajo de id_usuario
        . Generar los nuevos datos de prueba a esta tabla actualizada (porque ahora debo pasarle los id de producto)
        
        . Revisar postman/codigo para ver que nada rompa
    */
});

$app->group('/productos', function (RouteCollectorProxy $group) {
    // $group->get('[/]', \ProductoController::class . ':TraerTodos');
    // $group->get('/{producto}', \ProductoController::class . ':TraerUno');
    // $group->post('[/]', \ProductoController::class . ':CargarUno');
    // $group->put('/{producto}', \ProductoController::class . ':ModificarUno');
    // $group->delete('/{producto}', \ProductoController::class . ':BorrarUno');
});

$app->run();
?>