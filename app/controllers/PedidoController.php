<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Pedido.php';

class PedidoController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $pedidosPorUsuario = isset($queryParams['usuario'])
            ? $queryParams['usuario']
            : false;
        if ($pedidosPorUsuario) {
            $lista = Pedido::obtenerTodosPorUsuario($pedidosPorUsuario);
        } else {
            $lista = Pedido::obtenerTodos();
        }
        $payload = json_encode(["listaPedidos" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerDisponibles($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['usuario'];
        $lista = Pedido::obtenerDisponibles($id);
        $payload = json_encode(["listaPedidosDisponibles" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $id = $args['pedido'];
        $traerTodos = isset($queryParams['pedido_completo'])
            ? filter_var($queryParams['pedido_completo'], FILTER_VALIDATE_BOOLEAN)
            : false;

        if ($traerTodos) {
            $pedido = Pedido::obtenerPedidosPorCodigo($id);
        } else {
            $pedido = Pedido::obtenerPedidoPorId($id);
        }

        $payload = json_encode(["pedido" => $pedido]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        try {
            $parametros = $request->getParsedBody();
            $codigoPedido = isset($parametros['codigo_pedido'])
                ? $parametros['codigo_pedido']
                : PedidoController::GenerarCodigo(5);
            PedidoController::ValidarCodigo($codigoPedido);
            $idProducto = $parametros['id_producto'];
            $idMesa = $parametros['id_mesa'];
            $idUsuario = $parametros['id_usuario'];
            $nombreCliente = $parametros['nombre_cliente'];
            $descripcion = $parametros['descripcion'] ?? '';
            $foto = $parametros['foto'] ?? '';

            $pedido = new Pedido();
            $pedido->setCodigoPedido($codigoPedido);
            $pedido->setIdProducto($idProducto);
            $pedido->setIdMesa($idMesa);
            $pedido->setIdUsuario($idUsuario);
            $pedido->setNombreCliente($nombreCliente);
            $pedido->setFoto($foto);
            $pedido->setDescripcion($descripcion);
            $res = $pedido->crearPedido();
            if (!$res) {
                $payload = json_encode(array("mensaje" => "El codigo de pedido $codigoPedido se encuentra dado de baja."));
            } else {
                $payload = json_encode(array("mensaje" => "Pedido $res creado con exito"));
            }
        } catch (Exception $err) {
            $payload = json_encode(array("error" => $err->getMessage()));
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['pedido'];
        $idProducto = $parametros['id_producto'];
        $idMesa = $parametros['id_mesa'];
        $idUsuario = $parametros['id_usuario'];
        $nombreCliente = $parametros['nombre_cliente'];
        $descripcion = $parametros['descripcion'] ?? '';
        $estado = $parametros['estado'] ?? 1; // TODO: el estado que se recibe debe ser entre los valores posibles

        $pedido = new Pedido();
        $pedido->setId($id);
        $pedido->setIdProducto((int) $idProducto);
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

    public function TomarFoto($request, $response, $args)
    {
        try {
            $archivos = $request->getUploadedFiles();
            $parametros = $request->getParsedBody();
            $idPedido = $args['pedido'];
            $idUsuario = $parametros['id_usuario'];

            $pedido = new Pedido();
            $pedido->setId($idPedido);
            $res = $pedido->actualizarFoto($archivos['foto'], $idUsuario);

            if (!$res) {
                $payload = json_encode(array("error" => "El pedido $idPedido no existe"));
            } else {
                $payload = json_encode(array("mensaje" => "Foto subida al pedido con exito"));
            }
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public static function GenerarCodigo($length)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars .= "abcdefghijklmnopqrstuvwxyz";
        $chars .= "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public static function ValidarCodigo($codigo)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $codigo) || strlen($codigo) != 5) {
            throw new Exception('El codigo debe ser alfanumerico y de 5 caracteres de longitud.');
        }
    }
}

?>