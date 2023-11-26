<?php

require_once './interfaces/IApiUsable.php';
require_once './models/Mesa.php';
require_once './models/Usuario.php';

class CSVController
{
    public function DescargarEntidad($request, $response, $args)
    {
        try {
            $queryParams = $request->getQueryParams();
            $dir = '';
            $entidad = isset($queryParams['entidad'])
                ? $queryParams['entidad']
                : false;

            if (!$entidad) {
                throw new Exception('Para descargar una entidad debe especificarla como parametro.');
            }

            switch ($entidad) {
                case 'usuarios':
                    $dir = 'usuarios';
                    $bdUsuarios = Usuario::obtenerTodosCSV();
                    Usuario::DescargaUsuarios($bdUsuarios);
                    break;
                default:
                    throw new Exception('Entidad no contemplada.');
            }


            $payload = json_encode(["mensaje" => "Se descargo correctamente el CSV en /public/$dir.csv"]);
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    public function CargarEntidad($request, $response, $args)
    {
        try {
            $archivos = $request->getUploadedFiles();
            $queryParams = $request->getQueryParams();

            $archivo = $archivos['archivo'];
            $entidad = isset($queryParams['entidad'])
                ? $queryParams['entidad']
                : false;
            $dir = '';

            if (!$entidad) {
                throw new Exception('Para cargar una entidad debe especificarla como parametro.');
            }

            switch ($entidad) {
                case 'usuarios':
                    $dir = 'usuarios';
                    Usuario::CargarUsuarios($archivo->getStream()->getMetadata('uri'));
                    break;
                default:
                    throw new Exception('Entidad no contemplada.');
            }


            $payload = json_encode(["mensaje" => "Se cargo correctamente la entidad $dir desde el csv en la base de datos"]);
        } catch (Exception $err) {
            $payload = json_encode(['error' => $err->getMessage()]);
        } finally {
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

}

?>