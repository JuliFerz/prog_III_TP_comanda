<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Encuesta.php';
require_once './models/Pedido.php';

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
        try {
            $parametros = $request->getParsedBody();
            $codigoPedido = $parametros['codigo_pedido'];
            $puntosMesa = $parametros['puntos_mesa'];
            $puntosRestaurante = $parametros['puntos_restaurante'];
            $puntosMozo = $parametros['puntos_mozo'];
            $puntosCocinero = $parametros['puntos_cocinero'];
            $comentarios = $parametros['comentarios'];

            $bdPedidos = Pedido::obtenerCodigoExistente($codigoPedido);
            if (!$bdPedidos){
                throw new Exception("No se encontro un pedido con codigo $codigoPedido.");
            }
            if (Encuesta::obtenerPedidoYaCalificado($codigoPedido)){ 
                throw new Exception("El pedido $codigoPedido ya fue calificado.");
            }
            EncuestaController::ValidarComentario($comentarios);

            $encuesta = new Encuesta();
            $encuesta->setCodigoPedido($codigoPedido);
            $encuesta->setPuntosMesa($puntosMesa);
            $encuesta->setPuntosRestaurante($puntosRestaurante);
            $encuesta->setPuntosMozo($puntosMozo);
            $encuesta->setPuntosCocinero($puntosCocinero);
            $encuesta->setComentarios($comentarios);
            $res = $encuesta->crearEncuesta();

            // Se agrega el ID de encuesta en los pedidos involucrados
            foreach($bdPedidos as $pedido){
                $pedido->{'id_encuesta'} = $res;
                $pedido->modificarPedido(true);
            }

            $payload = json_encode(array("mensaje" => "Encuesta $res creada con exito"));
        } catch (Exception $err) {
            $payload = json_encode(array("error" => $err->getMessage()));
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function ModificarUno($request, $response, $args)
    {
        try{
            $parametros = $request->getParsedBody();
            $id = $args['encuesta'];
            $codigoPedido = $parametros['codigo_pedido'];
            $puntosMesa = $parametros['puntos_mesa'];
            $puntosRestaurante = $parametros['puntos_restaurante'];
            $puntosMozo = $parametros['puntos_mozo'];
            $puntosCocinero = $parametros['puntos_cocinero'];
            $comentarios = $parametros['comentarios'];

            EncuestaController::ValidarComentario($comentarios);
            if (!Encuesta::obtenerEncuestaPorId($id)){ 
                throw new Exception("La encuesta $id no existe");
            }

            $encuesta = new Encuesta();
            $encuesta->setId($id);
            $encuesta->setCodigoPedido($codigoPedido);
            $encuesta->setPuntosMesa($puntosMesa);
            $encuesta->setPuntosRestaurante($puntosRestaurante);
            $encuesta->setPuntosMozo($puntosMozo);
            $encuesta->setPuntosCocinero($puntosCocinero);
            $encuesta->setComentarios($comentarios);

            $encuesta->modificarEncuesta();
            $payload = json_encode(array("mensaje" => "Encuesta modificada con exito"));
        } catch (Exception $err) {
            $payload = json_encode(array("error" => $err->getMessage()));
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
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

    public static function ValidarComentario($strDescripcion){
        $lenDesc = strlen($strDescripcion);
        if ($lenDesc > 66){
            throw new Exception("La cantidad de caracteres de los comentarios ($lenDesc) supero el maximo permitido (66).");
        }
    }
}

?>