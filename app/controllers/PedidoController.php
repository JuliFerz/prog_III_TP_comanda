<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Pedido.php';
require_once './models/Producto.php';
require_once './models/Mesa.php';
require_once './models/Usuario.php';

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
            $nombreCliente = $parametros['nombre_cliente'];
            $descripcion = $parametros['descripcion'] ?? '';

            $bdProducto = Producto::obtenerProductoDisponible($idProducto);
            if (!$bdProducto) {
                throw new Exception("El producto $idProducto no existe, o se encuentra sin stock, o se encuentra dado de baja.");
            }
            $bdProducto->{'stock'} -= 1;
            $bdProducto->modificarProducto(true);

            if (!isset($parametros['codigo_pedido'])) {
                $bdMesa = Mesa::obtenerMesaDisponible($idMesa);
                if (!$bdMesa) {
                    throw new Exception("La mesa $idMesa no existe, o no se encuentra disponible.");
                }
                $bdMesa->{'estado'} = 'con cliente esperando pedido';
                $bdMesa->{'codigo_pedido'} = $codigoPedido;
                $bdMesa->modificarMesa(true);
            }

            $pedido = new Pedido();
            $pedido->setCodigoPedido($codigoPedido);
            $pedido->setIdProducto($idProducto);
            $pedido->setIdMesa($idMesa);
            $pedido->setNombreCliente($nombreCliente);
            $pedido->setDescripcion($descripcion);
            $res = $pedido->crearPedido();
            $codigoNuevo = Pedido::obtenerCodigoPedido($res)->{'codigo_pedido'};
            if (!$res) {
                $payload = json_encode(array("mensaje" => "El codigo de pedido $codigoPedido se encuentra dado de baja."));
            } else {
                $payload = json_encode(array("mensaje" => "Pedido $res ($codigoNuevo) creado con exito"));
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
        try {
            $parametros = $request->getParsedBody();

            $id = $args['pedido'];
            $idProducto = $parametros['id_producto'];
            $idMesa = $parametros['id_mesa'];
            $idUsuario = $parametros['id_usuario'] ?? '';
            $tiempoPreparacion = $parametros['tiempo_preparacion'] ?? null;
            $nombreCliente = $parametros['nombre_cliente'];
            $descripcion = $parametros['descripcion'] ?? '';
            $estado = $parametros['estado'] ?? 1; // TODO: el estado que se recibe debe ser entre los valores posibles

            $bdPedido = Pedido::obtenerPedidoPorId($id);
            if (!$bdPedido) {
                throw new Exception("El pedido $id no existe");
            }
            $bdProducto = Producto::obtenerProductoDisponible($idProducto);
            if (!$bdProducto) {
                throw new Exception("El producto $idProducto no existe, o se encuentra sin stock, o se encuentra dado de baja.");
            }

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setIdProducto((int) $idProducto);
            $pedido->setIdMesa((int) $idMesa);
            $pedido->setIdUsuario((int) $idUsuario);
            $pedido->setTiempoPreparacion((int) $tiempoPreparacion);
            $pedido->setNombreCliente($nombreCliente);
            $pedido->setDescripcion($descripcion);
            $pedido->setEstado($estado);
            $pedido->modificarPedido();

            $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
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

    public function PrepararPedido($request, $response, $args)
    {
        try {
            $parametros = $request->getParsedBody();
            $idPedido = $args['pedido'];
            $idUsuario = $parametros['id_usuario'];

            $bdPedido = Pedido::obtenerPedidoPorId($idPedido);
            if (!$bdPedido) {
                throw new Exception("El pedido $idPedido no existe");
            }
            $bdPedidoValido = (boolean) Pedido::obtenerPedidoValidoPorIdUsuario($idPedido, $idUsuario);
            if (!$bdPedidoValido) {
                throw new Exception("El pedido ya se encuentra asignado, o el sector del usuario $idUsuario no corresponde con el sector del producto del pedido $idPedido");
            }
            $bdUsuario = Usuario::obtenerUsuarioDisponible($idUsuario);
            if (!$bdUsuario) {
                throw new Exception("El usuario $idUsuario no existe, o no se encuentra disponible.");
            }
            // Modificaciones al usuario del pedido
            $bdUsuario->{'estado'} = 0;
            $bdUsuario->modificarUsuario(true);

            // Modificaciones al pedido
            $bdPedido->{'id_usuario'} = $idUsuario;
            $bdPedido->{'estado'} = "en preparacion";
            $bdPedido->modificarPedido(true);

            // Modificaciones al pedido completo
            $bdPedidoCompleto = Pedido::obtenerPedidosPorCodigo($idPedido);
            $tiempoTotal = array_reduce($bdPedidoCompleto, 
                function ($acumulador, $pedido) {
                    $bdProducto = Producto::obtenerProductoPorId($pedido->{'id_producto'});
                    if ($pedido->{'id_usuario'} != null){
                        return $acumulador + $bdProducto->{'tiempo_preparacion'};
                    }
                    return $acumulador;
                }, 0);
            foreach ($bdPedidoCompleto as $pedido) {
                $pedido->{'tiempo_preparacion'} = $tiempoTotal;
                $pedido->modificarPedido(true);
            }

            // Modificacion a la mesa
            $bdMesa = Mesa::obtenerMesaPorId($bdPedido->{'id_mesa'});
            $bdMesa->{'tiempo_preparacion'} = $tiempoTotal;
            $bdMesa->modificarMesa(true);

            $payload = json_encode(array("mensaje" => "Pedido asignado al usuario $idUsuario con exito"));
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function CompletarPedido($request, $response, $args)
    {
        try {
            $id = $args['pedido'];
            $bdPedidos = Pedido::obtenerPedidosPorCodigo($id);
            if(!$bdPedidos) {
                throw new Exception("No existe un pedido con el id $id");
            }
            $codigoPedido = $bdPedidos[0]->{'codigo_pedido'};

            // Validar pedido completo
            array_map(function ($pedido) use ($codigoPedido) {
                if ($pedido->{'id_usuario'} == NULL) {
                    $idP = $pedido->{'id'};
                    throw new Exception("El pedido no esta completo. El pedido $idP esta sin usuario asignado");
                }
                if ($pedido->{'estado'} == 'listo para servir') {
                    $idP = $pedido->{'id'};
                    throw new Exception("El pedido $idP ($codigoPedido) ya se encuentra listo para servir");
                }
            }, $bdPedidos);

            foreach($bdPedidos as $pedido){
                // Modificaciones al usuario del pedido
                $usuario = Usuario::obtenerUsuario($pedido->{'id_usuario'});
                $usuario->{'estado'} = 1;
                $usuario->modificarUsuario(true);
                
                // Modificaciones al pedido
                $pedido->{'estado'} = 'listo para servir';
                $pedido->modificarPedido(true);
            }
            $bdMesa = Mesa::obtenerMesaPorCodigo($codigoPedido);
            $bdMesa->{'estado'} = 'con cliente comiendo';
            $bdMesa->modificarMesa(true);

            $payload = json_encode(array("mensaje" => "Pedido $codigoPedido completado correctamente"));
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function CobrarPedido($request, $response, $args)
    {
        try {
            $id = $args['pedido'];
            $bdPedido = Pedido::obtenerPedidoPorId($id);
            if(!$bdPedido) {
                throw new Exception("No existe un pedido con el id $id");
            }
            $codigoPedido = $bdPedido->{'codigo_pedido'};
            $idMesa = $bdPedido->{'id_mesa'};
            
            $bdMesa = Mesa::obtenerMesaPorId($idMesa);
            if ($bdMesa->{'fecha_baja'} != NULL){
                throw new Exception("La mesa $idMesa se encuentra dada de baja.");
            }
            if ($bdMesa->{'estado'} == 'con cliente pagando'){
                throw new Exception("La mesa $idMesa ya se esta cobrando.");
            }

            $bdMesa->{'estado'} = 'con cliente pagando';
            $bdMesa->modificarMesa(true);

            $payload = json_encode(array("mensaje" => "Cobrando a la mesa $idMesa con pedido $codigoPedido"));
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function CerrarPedido($request, $response, $args)
    {
        try {
            // TODO: esto solo lo puede hacer el socio
            $id = $args['pedido'];
            $bdPedidos = Pedido::obtenerPedidosPorCodigo($id);
            if(!$bdPedidos) {
                throw new Exception("No existe un pedido con el id $id");
            }
            $codigoPedido = $bdPedidos[0]->{'codigo_pedido'};
            $idMesa = $bdPedidos[0]->{'id_mesa'};

            // Baja logica del pedido completo
            foreach($bdPedidos as $pedido){
                Pedido::borrarPedido($pedido->{'id'});
            }
        
            $bdMesa = Mesa::obtenerMesaPorId($idMesa);

            if ($bdMesa->{'fecha_baja'} != NULL){
                throw new Exception("La mesa $idMesa ya se encuentra dada de baja.");
            }
            if ($bdMesa->{'estado'} == 'cerrada'){
                throw new Exception("La mesa $idMesa ya se encuentra cerrada.");
            }
            $bdMesa->{'estado'} = 'cerrada';
            $bdMesa->{'tiempo_preparacion'} = NULL;
            $bdMesa->{'codigo_pedido'} = NULL;
            $bdMesa->modificarMesa(true);

            $payload = json_encode(array("mensaje" => "El pedido $codigoPedido fue cerrado correctamente"));
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