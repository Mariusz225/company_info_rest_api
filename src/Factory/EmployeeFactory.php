<?php

namespace App\Factory;

use App\Entity\Employee;

class EmployeeFactory extends EntityFactory
{
    protected function getEntityClass(): string
    {
        return Employee::class;
    }

    public function getEntity(): Employee
    {
        return $this->entity;
    }

    protected function createEntity(): Employee
    {
        return new Employee();
    }

    protected function getRequiredParams(): array
    {
        return ['name', 'surname', 'email'];
    }

    protected function getOptionalParams(): array
    {
        return [];
    }
}
