<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Producto.php';

class ProductoController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Producto::obtenerTodos();
        $payload = json_encode(["listaProductos" => $lista]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $id = $args['producto'];
        $traerPorTipo = isset($queryParams['por_tipo'])
            ? filter_var($queryParams['por_tipo'], FILTER_VALIDATE_BOOLEAN)
            : false;

        if ($traerPorTipo) {
            $producto = Producto::obtenerProductosPorCodigo($id);
        } else {
            $producto = Producto::obtenerProductoPorId($id);
        }

        $payload = json_encode(["producto" => $producto]);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $idSector = $parametros['id_sector'];
        $precio = $parametros['precio'];
        $stock = $parametros['stock'];
        $tiempoPreparacion = $parametros['tiempo_preparacion'];
        $estado = $parametros['estado'] ?? 1;
        $fechaCreacion = new DateTime(date("d-m-Y"));

        $producto = new Producto();
        $producto->setNombre($nombre);
        $producto->setIdSector($idSector);
        $producto->setPrecio($precio);
        $producto->setStock($stock);
        $producto->setTiempoPreparacion($tiempoPreparacion);
        $producto->setEstado($estado);
        $producto->setFechaCreacion($fechaCreacion);
        $res = $producto->crearProducto();
        $payload = json_encode(array("mensaje" => "Producto $res creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['producto'];
        $nombre = $parametros['nombre'];
        $idSector = $parametros['id_sector'];
        $precio = $parametros['precio'];
        $stock = $parametros['stock'];
        $tiempoPreparacion = $parametros['tiempo_preparacion'];
        $estado = $parametros['estado'] ?? 1;

        $producto = new Producto();
        $producto->setId($id);
        $producto->setNombre($nombre);
        $producto->setIdSector($idSector);
        $producto->setPrecio($precio);
        $producto->setStock($stock);
        $producto->setTiempoPreparacion($tiempoPreparacion);
        $producto->setEstado($estado);
        $res = $producto->modificarProducto();

        if (!$res) {
            $payload = json_encode(array("error" => "El producto $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Producto modificado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['producto'];
        $res = Producto::borrarProducto($id);

        if (!$res) {
            $payload = json_encode(array("error" => "El producto $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Producto borrado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}

?>