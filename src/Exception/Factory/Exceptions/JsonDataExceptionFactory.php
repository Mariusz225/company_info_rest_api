<?php

namespace App\Exception\Factory\Exceptions;

use App\Exception\Factory\ExceptionFactory;
use App\Exception\JsonDataException;
use Throwable;

class JsonDataExceptionFactory extends ExceptionFactory
{
    /**
     * {@inheritdoc}
     */
    protected function getExceptionInfo(Throwable $exception): array
    {

        return  match ($exception->getMessage()) {
            JsonDataException::EXCEPTION_JSON_MISSING_POST_ELEMENTS => [JsonDataException::EXCEPTION_JSON_MISSING_POST_ELEMENTS, 400],
            default => [null, null]
        };
    }
}