<?php

namespace App\Service\Database;

use App\Exception\ConstraintViolationException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class EntityValidatorService
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /**
     * Validates a single entity.
     *
     * @param mixed $entity The entity to validate.
     *
     * @throws ConstraintViolationException If validation fails.
     */
    public function validateEntity(mixed $entity): void
    {
        $errors = $this->validator->validate($entity);
        if ($errors->count() > 0) {
            /** @var ConstraintViolation  $error */
            $error = $errors[0];
            throw new ConstraintViolationException($error->getMessage() . ' ( ' . $error->getInvalidValue() . ' )');
        }
    }

    /**
     * Validates an array of entities.
     *
     * @param array ...$entities The entities to validate.
     *
     * @throws ConstraintViolationException If validation fails for any entity.
     */
    public function validateEntities(array ... $entities): void
    {
        foreach ($entities as $entity) {
            $this->validateEntity($entity);
        }
    }
}
