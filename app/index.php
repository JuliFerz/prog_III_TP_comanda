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
require_once './controllers/ProductoController.php';
require_once './controllers/SectorController.php';
require_once './controllers/MesaController.php';
require_once './controllers/EncuestaController.php';

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
    $group->get('/disponibles', \PedidoController::class . ':TraerDisponibles');
    $group->get('[/]', \PedidoController::class . ':TraerTodos');
    $group->get('/{pedido}', \PedidoController::class . ':TraerUno');
    $group->post('[/]', \PedidoController::class . ':CargarUno');
    $group->put('/{pedido}', \PedidoController::class . ':ModificarUno');
    $group->delete('/{pedido}', \PedidoController::class . ':BorrarUno');
    $group->post('/{pedido}/tomarFoto', \PedidoController::class . ':TomarFoto');
    $group->post('/{pedido}/prepararPedido', \PedidoController::class . ':PrepararPedido');
    $group->post('/{pedido}/completarPedido', \PedidoController::class . ':CompletarPedido');
    $group->post('/{pedido}/cobrarPedido', \PedidoController::class . ':CobrarPedido');
    $group->post('/{pedido}/cerrarPedido', \PedidoController::class . ':CerrarPedido');
});

$app->group('/productos', function (RouteCollectorProxy $group) {
    $group->get('[/]', \ProductoController::class . ':TraerTodos');
    $group->get('/{producto}', \ProductoController::class . ':TraerUno');
    $group->post('[/]', \ProductoController::class . ':CargarUno');
    $group->put('/{producto}', \ProductoController::class . ':ModificarUno');
    $group->delete('/{producto}', \ProductoController::class . ':BorrarUno');
});

$app->group('/mesas', function (RouteCollectorProxy $group) {
    $group->get('[/]', \MesaController::class . ':TraerTodos');
    $group->get('/{mesa}', \MesaController::class . ':TraerUno');
    $group->get('/{cod_pedido}/estado', \MesaController::class . ':ConsultarEstado');
    $group->post('[/]', \MesaController::class . ':CargarUno');
    $group->put('/{mesa}', \MesaController::class . ':ModificarUno');
    $group->delete('/{mesa}', \MesaController::class . ':BorrarUno');
});

$app->group('/sectores', function (RouteCollectorProxy $group) {
    $group->get('[/]', \SectorController::class . ':TraerTodos');
    $group->get('/{sector}', \SectorController::class . ':TraerUno');
    $group->post('[/]', \SectorController::class . ':CargarUno');
    $group->put('/{sector}', \SectorController::class . ':ModificarUno');
    $group->delete('/{sector}', \SectorController::class . ':BorrarUno');
});

$app->group('/encuestas', function (RouteCollectorProxy $group) {
    $group->get('[/]', \EncuestaController::class . ':TraerTodos');
    $group->get('/{encuesta}', \EncuestaController::class . ':TraerUno');
    $group->post('[/]', \EncuestaController::class . ':CargarUno');
    $group->put('/{encuesta}', \EncuestaController::class . ':ModificarUno');
    $group->delete('/{encuesta}', \EncuestaController::class . ':BorrarUno');
});

$app->run();
?>