<?php

namespace App\App\Traits;

use Exception;
trait hasFormResponses
{
    protected $response;

    public function getResponse($response)
    {
        $this->response = explode('.',$response);

        return $this->handleResponse();
    }

    protected function handleResponse()
    {
        if($this->response[0] == 'error') {
            return $this->handleErrorResponse();
        }
        return $this->handleSuccessResponse();
    }

    protected function handleErrorResponse()
    {
        switch ($this->response[1]) {
            case 'store':
                return response()->json(['error' => 'No se pudo guardar el registro.'],401);
                break;
            case 'update':
                return response()->json(['error' => 'No se pudo modificar el registro.'],401);
                break;
            case 'destroy':
                return response()->json(['error' => 'No se pudo eliminar el registro.'],401);
                break;
            default:
                throw new Exception('No error Specified');
                break;
        }
    }

    protected function handleSuccessResponse()
    {
        switch ($this->response[1]) {
            case 'store':
                return response()->json(['success' => 'Registro guardado correctamente.'],200);
                break;
            case 'update':
                return response()->json(['success' => 'Registro modificado correctamente.'],200);
                break;
            case 'destroy':
                return response()->json(['success' => 'Registro Eliminado correctamente.'],200);
                break;
            default:
                throw new Exception('No Case Specified for Default Message');
                break;
        }
    }

    public function slugErrorResponse()
    {
        return response()->json(['errors' => ['slug' => 'Ya existe otro registro con ese slug']],422);
    }
}
