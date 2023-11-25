<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Mesa.php';

class MesaController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Mesa::obtenerTodos();
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

            $mensaje = "La mesa con pedido $codigoPedido";
            $mensaje .= $bdMesa->{'estado_pedido'} != 'listo para servir' 
                ? " le quedan $tiempoPedido minutos"
                : " finalizo en $tiempoPedido minutos";
            $mensaje .= ". La misma se encuentra en estado $estadoPedido";
            
            $payload = json_encode(["mesa" => $mensaje]);
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
        $estado = $parametros['estado'];

        $mesa = new Mesa();
        $mesa->setId($id);
        $mesa->setCodigoPedido($codigoPedido);
        $mesa->setTiempoPreparacion($tiempoPreparacion);
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