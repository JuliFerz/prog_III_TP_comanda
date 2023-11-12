<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Pedido.php';

class PedidoController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(["listaPedidos" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['pedido']; // se busca por ID
        $pedido = Pedido::obtenerPedido($id);

        $payload = json_encode(["pedido" => $pedido]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigoPedido = $parametros['codigoPedido'];
        $idMesa = $parametros['idMesa'];
        $idUsuario = $parametros['idUsuario'];
        $nombreCliente = $parametros['nombreCliente'];
        $descripcion = $parametros['descripcion'] ?? '';
        $estado = $parametros['estado'] ?? 1;

        $pedido = new Pedido();
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setIdMesa($idMesa);
        $pedido->setIdUsuario($idUsuario);
        $pedido->setNombreCliente($nombreCliente);
        $pedido->setDescripcion($descripcion);
        $pedido->setEstado($estado);
        $newPedido = $pedido->crearPedido();
        $payload = json_encode(array("mensaje" => "Pedido $newPedido creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['pedido'];
        $codigoPedido = $parametros['codigo_pedido'];
        $idMesa = $parametros['id_mesa'];
        $idUsuario = $parametros['id_usuario'];
        $nombreCliente = $parametros['nombre_cliente'];
        $descripcion = $parametros['descripcion'] ?? '';
        $estado = $parametros['estado'] ?? 1;

        $pedido = new Pedido();
        $pedido->setId($id);
        $pedido->setCodigoPedido((int)$codigoPedido);
        $pedido->setIdMesa((int) $idMesa);
        $pedido->setIdUsuario((int) $idUsuario);
        $pedido->setNombreCliente($nombreCliente);
        $pedido->setDescripcion($descripcion);
        $pedido->setEstado($estado);
        $res = $pedido->modificarPedido();

        if (!$res) {
            $payload = json_encode(array("error" => "El pedido $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));
        }
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['pedido'];
        $res = Pedido::borrarPedido($id);

        if (!$res) {
            $payload = json_encode(array("error" => "El pedido $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Pedido borrado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>