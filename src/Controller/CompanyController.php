<?php

namespace App\Controller;

use App\Exception\JsonDataException;
use App\Factory\CompanyFactory;
use App\Factory\EmployeeFactory;
use App\Service\App\CompanyService;
use App\Service\Database\DatabaseService;
use App\Service\Request\JsonDataProcessorService;
use Doctrine\DBAL\Exception;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/company', name: 'api_company.')]
class CompanyController extends AbstractController
{
    /**
     * Create a company with employees.
     *
     * @param JsonDataProcessorService $jsonDataProcessorService The service for processing JSON data.
     * @param DatabaseService $databaseService The service for handling database operations.
     * @param CompanyService $companyService The service for managing company-related operations.
     * @param CompanyFactory $companyFactory The factory for creating company entities.
     * @param EmployeeFactory $employeeFactory The factory for creating employee entities.
     *
     * @return JsonResponse The JSON response containing the created company's ID.
     *
     * @throws ReflectionException
     * @throws Exception|JsonDataException
     */
    #[Route('/createCompanyWithEmployees', name: 'createCompanyWithEmployees')]
    public function createCompanyWithEmployees(JsonDataProcessorService $jsonDataProcessorService, DatabaseService $databaseService, CompanyService $companyService, CompanyFactory $companyFactory, EmployeeFactory $employeeFactory): JsonResponse
    {
        $postData = $jsonDataProcessorService->getDecodedPostData();
        $company = $companyFactory->createEntityFromArray($postData['company'])->getEntity();
        $employees = $employeeFactory->createEntitiesFromArray($postData['company']['employees'] ?? []);
        $company = $companyService->addEmployersToCompany($company, $employees);
        $databaseService->flushDataToDatabase();
        return new JsonResponse(array('companyId' => $company->getId()), Response::HTTP_OK);
    }
}
