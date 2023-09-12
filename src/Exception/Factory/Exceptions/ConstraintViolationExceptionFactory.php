<?php

namespace App\Exception\Factory\Exceptions;

use App\Exception\Factory\ExceptionFactory;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ConstraintViolationExceptionFactory extends ExceptionFactory
{
    /**
     * {@inheritdoc}
     */
    protected function getExceptionInfo(Throwable $exception): array
    {
        return [$exception->getMessage(), Response::HTTP_BAD_REQUEST];
    }
}