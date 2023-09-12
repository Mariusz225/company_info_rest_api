<?php

namespace App\Exception\Factory;

use Exception;
use Throwable;

abstract class ExceptionFactory implements ExceptionFactoryInterface
{
    protected \Exception $exception;

    /**
     * Get information for creating an exception.
     *
     * @param Throwable $exception The original exception.
     *
     * @return array An array with two elements: the first element is the exception message, and the second element is the code.
     */
    abstract protected function getExceptionInfo(Throwable $exception): array;

    /**
     * Create a new exception based on the provided Throwable.
     *
     * @param Throwable $exception The original exception.
     *
     * @return Exception A new exception instance.
     */
    public function createException(Throwable $exception): Exception {
        [$message, $code] = $this->getExceptionInfo($exception);

        $message = $message ?? "Something gone wrong";
        $code = ($code === null || (int) $code === 0) ? 500 : $code;

        return new Exception($message, $code);
    }
}
