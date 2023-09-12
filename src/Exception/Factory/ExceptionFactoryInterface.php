<?php

namespace App\Exception\Factory;

use Exception;
use Throwable;

interface ExceptionFactoryInterface
{
    /**
     * Create a new exception based on the provided Throwable.
     *
     * @param Throwable $exception The original exception.
     *
     * @return Exception A new exception instance.
     */
    public function createException(Throwable $exception): Exception;
}