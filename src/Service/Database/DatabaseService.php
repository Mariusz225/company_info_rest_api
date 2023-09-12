<?php

namespace App\Service\Database;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseService
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * Flushes pending changes to the database.
     *
     * @throws Exception If an error occurs while flushing the data.
     */
    public function flushDataToDatabase(): void
    {
        try {
            $this->entityManager->flush();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
