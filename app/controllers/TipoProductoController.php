<?php

require_once './interfaces/IApiUsable.php';
require_once './models/TipoProducto.php';

class TipoProductoController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = TipoProducto::obtenerTodos();
        $payload = json_encode(["listaTipoProductos" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['tipo'];
        $tipoProducto = TipoProducto::obtenerTipoProductoPorId($id);

        $payload = json_encode(["tipoProducto" => $tipoProducto]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $tipoProducto = new TipoProducto();
        $tipoProducto->setNombre($nombre);
        $res = $tipoProducto->crearTipoProducto();

        if (!$res){
            $payload = json_encode(array("mensaje" => "Ya existe un producto $nombre"));
        } else {
            $payload = json_encode(array("mensaje" => "Tipo de producto $res creado con exito"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['tipo'];
        $nombre = $parametros['nombre'];

        $tipoProducto = new TipoProducto();
        $tipoProducto->setId($id);
        $tipoProducto->setNombre($nombre);
        $res = $tipoProducto->modificarTpoProducto();

        if (!$res) {
            $payload = json_encode(array("error" => "El tipo de producto $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Tipo de producto modificado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['tipo'];
        $res = TipoProducto::borrarTipoProducto($id);

        if (!$res) {
            $payload = json_encode(array("error" => "El tipo de producto $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Tipo de producto borrado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>