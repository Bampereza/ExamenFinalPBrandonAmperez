<?php

namespace App\Exceptions;

use Exception;

class TransporteNoAsignadoException extends Exception
{
    public function __construct($message = 'No se ha asignado un transporte al camión', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
