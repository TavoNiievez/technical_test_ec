<?php

namespace App\Netflix\Clients\Infrastructure\Repository;

use App\Netflix\Clients\Domain\Entity\Client;
use App\Netflix\Clients\Domain\Repository\ClientRepository;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;
use Doctrine\ORM\EntityManager;
use Exception;

class MariaDBClientRepository implements ClientRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->entityManager->getRepository(Client::class)->findBy(
            $criteria->filters(),
            $criteria->orders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    /**
     * @inheritDoc
     */
    public function save(Client $client): void
    {
        try {
            $this->entityManager->persist($client);
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $e) {
            throw new UnableToPersist($e->getMessage(), $e->getCode(), $e);
        }
    }
}