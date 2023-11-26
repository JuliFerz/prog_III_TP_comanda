<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Usuario.php';
require_once './models/Sector.php';

class UsuarioController implements IApiUsable
{
    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuarios" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['usuario']; // se busca por ID
        $usuario = Usuario::obtenerUsuario($id);

        $payload = json_encode(array("usuario" => $usuario));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function CargarUno($request, $response, $args)
    {
        try {
            $parametros = $request->getParsedBody();
            $usuario = $parametros['usuario'];
            $clave = $parametros['clave'];
            $nombre = $parametros['nombre'];
            $apellido = $parametros['apellido'];
            $correo = $parametros['correo'];
            $idSector = $parametros['id_sector'];
            $estado = $parametros['estado'] ?? 1;
            $prioridad = $parametros['prioridad'] ?? 1;

            $bdSector = Sector::obtenerSectorDisponible($idSector);
            if (!$bdSector) {
                $sectorTodos = Sector::obtenerTodos();
                $strDisponibles = '';

                foreach ($sectorTodos as $sector){
                    if ($sector->{'fecha_baja'} != null){
                        continue;
                    }
                    $idS = $sector->{'id'};
                    $detalleS = $sector->{'detalle'};
                    $strDisponibles .= "$detalleS ($idS), ";
                }
                $strDisponibles = substr($strDisponibles, 0, strlen($strDisponibles) - 2);

                throw new Exception("El sector $idSector no esta disponible. Los sectores disponibles son: $strDisponibles.");
            }

            $usr = new Usuario();
            $usr->setUsuario($usuario);
            $usr->setClave($clave);
            $usr->setNombre($nombre);
            $usr->setApellido($apellido);
            $usr->setCorreo($correo);
            $usr->setIdSector($idSector);
            $usr->setEstado($estado);
            $usr->setPrioridad($prioridad);
            $newUserId = $usr->crearUsuario();
            $payload = json_encode(array("mensaje" => "Usuario $newUserId creado con exito"));
        } catch (Exception $err) {
            $payload = json_encode(array("error" => $err->getMessage()));
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function ModificarUno($request, $response, $args)
    {
        try{
            $parametros = $request->getParsedBody();

            $id = $args['usuario'];
            $usuario = $parametros['usuario'];
            $clave = $parametros['clave'];
            $nombre = $parametros['nombre'];
            $apellido = $parametros['apellido'];
            $correo = $parametros['correo'];
            $idSector = $parametros['id_sector'];
            $estado = $parametros['estado'] ?? 1;
            $prioridad = $parametros['prioridad'] ?? 1;

            $bdSector = Sector::obtenerSectorDisponible($idSector);
            if (!$bdSector) {
                $sectorTodos = Sector::obtenerTodos();
                $strDisponibles = '';

                foreach ($sectorTodos as $sector){
                    if ($sector->{'fecha_baja'} != null){
                        continue;
                    }
                    $idS = $sector->{'id'};
                    $detalleS = $sector->{'detalle'};
                    $strDisponibles .= "$detalleS ($idS), ";
                }
                $strDisponibles = substr($strDisponibles, 0, strlen($strDisponibles) - 2);

                throw new Exception("El sector $idSector no esta disponible. Los sectores disponibles son: $strDisponibles.");
            }

            $bdUser = Usuario::obtenerUsuario($id);
            if (!$bdUser) {
                throw new Exception("El usuario $id no existe");
            }

            $usr = new Usuario();
            $usr->setId($id);
            $usr->setUsuario($usuario);
            $usr->setClave($clave);
            $usr->setNombre($nombre);
            $usr->setApellido($apellido);
            $usr->setCorreo($correo);
            $usr->setIdSector($idSector);
            $usr->setEstado($estado);
            $usr->setPrioridad($prioridad);
            $usr->modificarUsuario();
            $payload = json_encode(array("mensaje" => "Usuario $id modificado con exito"));
        } catch (Exception $err) {
            $payload = json_encode(array("error" => $err->getMessage()));
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['usuario'];
        $res = Usuario::borrarUsuario($id);

        if (!$res) {
            $payload = json_encode(array("error" => "El usuario $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));
        }
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

}

?>