<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Usuario.php';

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
        $parametros = $request->getParsedBody();
        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];
        $sector = $parametros['sector'];
        $prioridad = $parametros['prioridad'] ?? 1;

        if ($sector != "bartender" && $sector != "cervecero" && $sector != "cocinero" && $sector != "mozo" && $sector != "socio" /*  && $sector != "Cliente" */) {
            $response->getBody()->write(json_encode(['error' => 'Sector incorrecto. Valores correctos: bartender, cervecero, cocinero, mozo o socio']));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $usr = new Usuario();
        $usr->setUsuario($usuario);
        $usr->setClave($clave);
        $usr->setSector($sector);
        $usr->setPrioridad($prioridad);
        $newUserId = $usr->crearUsuario();
        $payload = json_encode(array("mensaje" => "Usuario $newUserId creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $args['usuario'];
        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];
        $sector = $parametros['sector'];
        $prioridad = $parametros['prioridad'] ?? 1;

        if ($sector != "bartender" && $sector != "cervecero" && $sector != "cocinero" && $sector != "mozo" && $sector != "socio" /*  && $sector != "Cliente" */) {
            $response->getBody()->write(json_encode(['error' => 'Sector incorrecto. Valores correctos: bartender, cervecero, cocinero, mozo o socio']));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $usr = new Usuario();
        $usr->setId($id);
        $usr->setUsuario($usuario);
        $usr->setClave($clave);
        $usr->setSector($sector);
        $usr->setPrioridad($prioridad);
        $res = $usr->modificarUsuario();

        if (!$res) {
            $payload = json_encode(array("error" => "El usuario $id no existe"));
        } else {
            $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
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