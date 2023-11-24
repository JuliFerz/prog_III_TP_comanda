<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Sector.php';

class SectorController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Sector::obtenerTodos();
        $payload = json_encode(["listaSectores" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['sector'];
        $sector = Sector::obtenerSectorPorId($id);

        $payload = json_encode(["sector" => $sector]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $detalle = $parametros['detalle'];
        $sector = new Sector();
        $sector->setDetalle($detalle);
        $res = $sector->crearSector();

        if (!$res){
            $payload = json_encode(array("mensaje" => "Ya existe un sector $detalle"));
        } else {
            $payload = json_encode(array("mensaje" => "Sector $res creado con exito"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['sector'];
        $detalle = $parametros['detalle'];

        $sector = new Sector();
        $sector->setId($id);
        $sector->setDetalle($detalle);
        $res = $sector->modificarSector();

        if (!$res) {
            $payload = json_encode(array("error" => "El sector $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Sector modificado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['sector'];
        $res = Sector::borrarSector($id);

        if (!$res) {
            $payload = json_encode(array("error" => "El sector $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Sector borrado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>