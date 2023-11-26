<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Mesa.php';

class MesaController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $masUsadas = isset($queryParams['mas_usadas'])
            ? filter_var($queryParams['mas_usadas'], FILTER_VALIDATE_BOOLEAN)
            : false;

        if ($masUsadas) {
            $lista = Mesa::obtenerMasUsadas();
        } else {
            $lista = Mesa::obtenerTodos();
        }
        $payload = json_encode(["listaMesas" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['mesa'];
        $mesa = Mesa::obtenerMesaPorId($id);

        $payload = json_encode(["mesa" => $mesa]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ConsultarEstado($request, $response, $args)
    {
        try {
            $codigoPedido = $args['cod_pedido'];
            MesaController::ValidarCodigo($codigoPedido);
            $bdMesa = Mesa::obtenerMesaPorCodigo($codigoPedido);
            $estadoPedido = $bdMesa->{'estado_pedido'};
            $tiempoPedido = $bdMesa->{'tiempo_preparacion'};

            $payload = json_encode(["mesa" => $bdMesa->{'id'}, "codigo_pedido" => $codigoPedido, "estado" => $estadoPedido, "tiempo_pedido" => $tiempoPedido]);
        } catch (Exception $err) {
            $payload = json_encode(["error" => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $estado = $parametros['estado'] ?? 'libre';

        $mesa = new Mesa();
        $mesa->setEstado($estado);
        $res = $mesa->crearMesa();
        $payload = json_encode(array("mensaje" => "Mesa $res creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['mesa'];
        $codigoPedido = $parametros['codigo_pedido'] ?? null;
        $tiempoPreparacion = $parametros['tiempo_preparacion'] ?? null;
        $vecesUsada = $parametros['veces_usada'] ?? null;
        $estado = $parametros['estado'];

        $mesa = new Mesa();
        $mesa->setId($id);
        $mesa->setCodigoPedido($codigoPedido);
        $mesa->setTiempoPreparacion($tiempoPreparacion);
        $mesa->setVecesUsada($vecesUsada);
        $mesa->setEstado($estado);
        $res = $mesa->modificarMesa();

        if (!$res) {
            $payload = json_encode(array("error" => "La mesa $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Mesa modificada con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['mesa'];
        $res = Mesa::borrarMesa($id);

        if (!$res) {
            $payload = json_encode(array("error" => "La mesa $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Mesa borrada con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public static function ValidarCodigo($codigo)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $codigo) || strlen($codigo) != 5) {
            throw new Exception('El codigo debe ser alfanumerico y de 5 caracteres de longitud.');
        }
    }
}

?>