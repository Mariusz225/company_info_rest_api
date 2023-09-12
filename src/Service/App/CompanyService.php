<?php

namespace App\Service\App;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

class CompanyService
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * Adds employees to a company.
     *
     * @param Company $company The company to which employees will be added.
     * @param array $employees An array of employees to add to the company.
     *
     * @return Company The updated company object.
     */
    public function addEmployersToCompany(Company $company, array $employees): Company
    {
        foreach ($employees as $employee) {
            $company->addEmployee($employee);
        }
        $this->entityManager->persist($company);
        return $company;
    }
}
