<?php

namespace App\Factory;

use App\Exception\JsonDataException;
use App\Helper\ArrayHelper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use ReflectionException;

abstract class EntityFactory
{
    protected $entity;

    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get the fully qualified class name of the entity.
     *
     * @return string
     */

    abstract protected function getEntityClass(): string;

    /**
     * Get the entity object.
     *
     * @return mixed
     */
    abstract public function getEntity(): mixed;

    /**
     * Create a new entity instance.
     *
     * @return mixed
     */
    abstract protected function createEntity(): mixed;

    /**
     * Get an array of required parameters for entity creation.
     *
     * @return array
     */
    abstract protected function getRequiredParams(): array;

    /**
     * Get an array of optional parameters for entity creation.
     *
     * @return array
     */
    abstract protected function getOptionalParams(): array;

    /**
     * Create an entity from an associative array.
     *
     * @param array $array The input data array.
     * @return static
     * @throws ReflectionException
     * @throws Exception
     * @throws JsonDataException
     */
    public function createEntityFromArray(array $array): static
    {
        if(!ArrayHelper::areAllElementsMappedInKeys($this->getRequiredParams(), $array)) {
            throw new JsonDataException(JsonDataException::EXCEPTION_JSON_MISSING_POST_ELEMENTS);
        }

        $this->entity = $this->createEntity();
        $this->setAllParametersFromArray($array);
        $this->entityManager->persist($this->getEntity());
        return $this;
    }

    /**
     * Create multiple entities from an array of entity data arrays.
     *
     * @param array $entityArrays The array of entity data arrays.
     * @return array
     * @throws JsonDataException|ReflectionException
     */
    public function createEntitiesFromArray(array $entityArrays): array
    {
        $entities = [];
        $reflectionClass = new \ReflectionClass($this->getEntityClass());

        foreach ($entityArrays as $entityArray) {
            $this->entity = $this->createEntity();

            $entities[] = $this->createEntityFromArray($entityArray[lcfirst(($reflectionClass->getShortName()))])->getEntity();

        }
        return $entities;
    }

    /**
     * Set all entity parameters from an associative array.
     *
     * @param array $array The input data array.
     * @throws ReflectionException
     */
    private function setAllParametersFromArray(array $array): void
    {
        foreach ($this->getParams() as $param) {
            $setterMethodName = 'set' . ucfirst($param);
            if (method_exists($this->entity, $setterMethodName)) {
                if (!array_key_exists($param, $array)) continue;
                $parameters[$param] = $array[$param] ?? null;
                $this->entity->$setterMethodName($array[$param]);
            }
        }
    }

    /**
     * Get all parameters required for entity creation.
     *
     * @return array
     */
    final protected function getParams(): array
    {
        return array_merge($this->getRequiredParams(), $this->getOptionalParams());
    }
}
