<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Encuesta.php';

class EncuestaController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Encuesta::obtenerTodos();
        $payload = json_encode(["listaEncuestas" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['encuesta'];
        $encuesta = Encuesta::obtenerEncuestaPorId($id);

        $payload = json_encode(["encuesta" => $encuesta]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigoPedido = $parametros['codigo_pedido'];
        $puntosMesa = $parametros['puntos_mesa'];
        $puntosRestaurante = $parametros['puntos_restaurante'];
        $puntosMozo = $parametros['puntos_mozo'];
        $puntosCocinero = $parametros['puntos_cocinero'];
        $comentarios = $parametros['comentarios'];

        $encuesta = new Encuesta();
        $encuesta->setCodigoPedido($codigoPedido);
        $encuesta->setPuntosMesa($puntosMesa);
        $encuesta->setPuntosRestaurante($puntosRestaurante);
        $encuesta->setPuntosMozo($puntosMozo);
        $encuesta->setPuntosCocinero($puntosCocinero);
        $encuesta->setComentarios($comentarios); // TODO: controlar 66 caracteres
        $res = $encuesta->crearEncuesta();
        if (!$res){
            $payload = json_encode(array("mensaje" => "El pedido $codigoPedido ya fue calificado."));
        } else {
            $payload = json_encode(array("mensaje" => "Encuesta $res creada con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['encuesta'];
        $codigoPedido = $parametros['codigo_pedido'];
        $puntosMesa = $parametros['puntos_mesa'];
        $puntosRestaurante = $parametros['puntos_restaurante'];
        $puntosMozo = $parametros['puntos_mozo'];
        $puntosCocinero = $parametros['puntos_cocinero'];
        $comentarios = $parametros['comentarios'];

        $encuesta = new Encuesta();
        $encuesta->setId($id);
        $encuesta->setCodigoPedido($codigoPedido);
        $encuesta->setPuntosMesa($puntosMesa);
        $encuesta->setPuntosRestaurante($puntosRestaurante);
        $encuesta->setPuntosMozo($puntosMozo);
        $encuesta->setPuntosCocinero($puntosCocinero);
        $encuesta->setComentarios($comentarios); // TODO: controlar 66 caracteres

        $res = $encuesta->modificarEncuesta();

        if (!$res) {
            $payload = json_encode(array("error" => "La encuesta $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Encuesta modificada con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['encuesta'];
        $res = Encuesta::borrarEncuesta($id);

        if (!$res) {
            $payload = json_encode(array("error" => "La encuesta $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Encuesta borrada con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>