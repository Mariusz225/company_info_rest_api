<?php

namespace App\Exception\Factory\Exceptions;

use App\Exception\Factory\ExceptionFactory;
use Doctrine\DBAL\Exception;

class DoctrineExceptionFactory extends ExceptionFactory
{
    /**
     * {@inheritdoc}
     */
    protected function getExceptionInfo($exception): array
    {
        /** @var Exception $exception */
        return  match ($exception->getCode()) {
            1062 => [$exception->getMessage(), 500],
            default => [null, null]
        };
    }
}
