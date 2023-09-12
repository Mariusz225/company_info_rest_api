<?php

namespace App\Exception\Factory;

use App\Exception\ConstraintViolationException;
use App\Exception\Factory\Exceptions\ConstraintViolationExceptionFactory;
use App\Exception\Factory\Exceptions\DefaultExceptionFactory;
use App\Exception\Factory\Exceptions\DoctrineExceptionFactory;
use App\Exception\Factory\Exceptions\JsonDataExceptionFactory;
use App\Exception\JsonDataException;
use Throwable;

class ExceptionFactoryHandler
{

    /**
     * Create a production exception based on the provided Throwable.
     *
     * @param Throwable $exception The original exception.
     *
     * @return Throwable A production exception instance.
     */
    public function createProductionException(Throwable $exception): \Throwable
    {
        $exceptionFactory = match (true) {
            $exception instanceof \Doctrine\DBAL\Exception => new DoctrineExceptionFactory(),
            $exception instanceof ConstraintViolationException => new ConstraintViolationExceptionFactory(),
            $exception instanceof JsonDataException => new JsonDataExceptionFactory(),
            default => new DefaultExceptionFactory()
        };

        return $exceptionFactory->createException($exception);
    }
}
