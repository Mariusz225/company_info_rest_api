<?php

namespace App\EventListener;

use App\Exception\ConstraintViolationException;
use App\Service\Database\EntityValidatorService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::preFlush)]
readonly class DatabaseListener implements EventSubscriber
{
    public function __construct(private EntityValidatorService $entityValidatorService)
    {
    }

    public function getSubscribedEvents(): array
    {

        return [
            Events::preFlush
        ];
    }

    /**
     * Validates entities before they are flushed to the database.
     *
     * @param PreFlushEventArgs $eventArgs The event arguments.
     *
     * @throws ConstraintViolationException If validation fails.
     */
    public function preFlush(PreFlushEventArgs $eventArgs): void
    {
        $em = $eventArgs->getObjectManager();
        $unitOfWork = $em->getUnitOfWork();

        $this->entityValidatorService->validateEntities($unitOfWork->getScheduledEntityInsertions(), $unitOfWork->getScheduledEntityUpdates());
    }
}
