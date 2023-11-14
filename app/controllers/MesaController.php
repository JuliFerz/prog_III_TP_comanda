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
        $queryParams = $request->getQueryParams();
        $id = $args['mesa'];
        $traerMesaCompleta = isset($queryParams['mesa_completa'])
            ? filter_var($queryParams['mesa_completa'], FILTER_VALIDATE_BOOLEAN)
            : false;

        if ($traerMesaCompleta) {
            $mesa = Mesa::obtenerMesasPorNumeroMesa($id);
        } else {
            $mesa = Mesa::obtenerMesaPorId($id);
        }

        $payload = json_encode(["mesa" => $mesa]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $numeroMesa = $parametros['numero_mesa'];
        $estado = $parametros['estado'] ?? 1; // TODO: no pasar este parametro

        $mesa = new Mesa();
        $mesa->setNumeroMesa($numeroMesa);
        $mesa->setEstado($estado);
        $res = $mesa->crearMesa();
        if (!$res){
            $payload = json_encode(array("mensaje" => "La mesa $numeroMesa se encuentra dada de baja"));
        } else {
            $payload = json_encode(array("mensaje" => "Mesa $res creado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['mesa'];
        $numeroMesa = $parametros['numero_mesa'];

        $mesa = new Mesa();
        $mesa->setId($id);
        $mesa->setNumeroMesa($numeroMesa);
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
}

?>