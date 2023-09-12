<?php

namespace App\Factory;

use App\Entity\Company;

class CompanyFactory extends EntityFactory
{
    protected function getEntityClass(): string
    {
        return Company::class;
    }
    public function getEntity(): Company
    {
        return $this->entity;
    }

    protected function createEntity(): Company
    {
        return new Company();
    }

    protected function getRequiredParams(): array
    {
        return ['name', 'nip', 'address', 'city', 'postcode'];
    }

    protected function getOptionalParams(): array
    {
        return ['test'];
    }
}
