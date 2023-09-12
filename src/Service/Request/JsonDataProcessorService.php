<?php

namespace App\Service\Request;


use Symfony\Component\HttpFoundation\RequestStack;

class JsonDataProcessorService
{
    private ?\Symfony\Component\HttpFoundation\Request $request;

    /**
     * JsonDataProcessorService constructor.
     *
     * @param RequestStack $requestStack The Symfony RequestStack for accessing the current request.
     */
    public function __construct(protected RequestStack $requestStack)
    {
        $this->request = $this->requestStack->getCurrentRequest();
    }

    /**
     * Get the decoded JSON data from the current request's content.
     *
     * @return array|null The decoded JSON data as an array or null if the content is not valid JSON.
     */
    public function getDecodedPostData(): array|null
    {
        return json_decode($this->request->getContent(), true);
    }
}
