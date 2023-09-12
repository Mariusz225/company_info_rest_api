<?php

namespace App\Exception\Factory\Exceptions;

use App\Exception\Factory\ExceptionFactory;
use Throwable;

class DefaultExceptionFactory extends ExceptionFactory
{
    /**
     * {@inheritdoc}
     */
    protected function getExceptionInfo(Throwable $exception): array
    {
        dd($exception);
        return [null, null];
    }
}
