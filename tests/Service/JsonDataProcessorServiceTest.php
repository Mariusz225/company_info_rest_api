<?php

namespace App\Tests\Service;

use App\Service\Request\JsonDataProcessorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class JsonDataProcessorServiceTest extends TestCase
{
    public function testGetDecodedPostData()
    {

        $jsonData = '{"key1": "value1", "key2": "value2"}';

        $request = Request::create('/test', 'POST', [], [], [], [], $jsonData);

        $requestStack = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();
        $requestStack->method('getCurrentRequest')->willReturn($request);

        $jsonDataProcessorService = new JsonDataProcessorService($requestStack);

        $decodedData = $jsonDataProcessorService->getDecodedPostData();

        $this->assertIsArray($decodedData);
        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'], $decodedData);
    }
}
