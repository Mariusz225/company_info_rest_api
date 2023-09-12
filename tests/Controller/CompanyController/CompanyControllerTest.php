<?php

namespace App\Tests\Controller\CompanyController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyControllerTest extends WebTestCase
{
    public function testCreateCompanyWithEmployees()
    {
        $jsonData = file_get_contents(__DIR__ . '/createCompanyWithEmployees.json');

        $postData = json_decode($jsonData, true);

        $client = static::createClient();

        $client->request('POST', '/api/company/createCompanyWithEmployees', [], [], [], json_encode($postData));

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('companyId', $responseData);
    }
}
