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

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $estado = $parametros['estado'] ?? 1; // TODO: no pasar este parametro

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
        $estado = $parametros['estado'];

        $mesa = new Mesa();
        $mesa->setId($id);
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
}

?>