<?php

namespace App\Exception;

use Exception;

class JsonDataException extends Exception
{
    public const EXCEPTION_JSON_MISSING_POST_ELEMENTS = 'Not all required parameters were passed';


}
