<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class FieldsMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {   
        try {
            $parametros = $request->getParsedBody();
            if (!isset($parametros['usuario']) 
                    || !isset($parametros['clave']) 
                    || !isset($parametros['nombre'])
                    || !isset($parametros['apellido'])
                    || !isset($parametros['correo'])
                    || !isset($parametros['id_sector'])){
                throw new Exception('No estan presentes todos los campos para la creacion de un usuario');
            } else if (gettype($parametros['usuario']) != 'string'
                    || gettype($parametros['clave']) != 'string'
                    || gettype($parametros['nombre']) != 'string'
                    || gettype($parametros['apellido']) != 'string'
                    || gettype($parametros['correo']) != 'string'
            ){
                throw new Exception('Los datos recibidos no cumplen con el formato correcto.');
            }
            $this->validateNumber($parametros['id_sector']);
            $response = $handler->handle($request);
        } catch (Exception $err){
            $response = new Response();
            $payload = json_encode(array('mensaje' => $err->getMessage()));
            $response->getBody()->write($payload);
        } finally {
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    private function validateNumber($str){
        if (!preg_match('/^[0-9]+$/', $str)) {
            throw new Exception('Se encontro un caracter no numerico.');
        }
    }
}
