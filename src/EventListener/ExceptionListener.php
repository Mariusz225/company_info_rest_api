<?php

namespace App\EventListener;

use App\Exception\Factory\ExceptionFactoryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;

class ExceptionListener
{
    private string $environment;

    public function __construct(KernelInterface $kernel, private readonly ExceptionFactoryHandler $exceptionFactoryHandler)
    {
        $this->environment = $kernel->getEnvironment();
    }

    /**
     * Handles exceptions and generates a JSON response for the production environment.
     *
     * @param ExceptionEvent $event The exception event.
     */
    public function __invoke(ExceptionEvent $event): void
    {
        if ($this->environment === "prod") {
            $exception = $event->getThrowable();

            $exception = $this->exceptionFactoryHandler->createProductionException($exception);

            $jsonResponse = new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            $event->setResponse($jsonResponse);
        }
    }
}
