<?php

namespace App\Netflix\Movies\Infrastructure\Repository;

use App\Netflix\Movies\Domain\Entity\Copy;
use App\Netflix\Movies\Domain\Repository\CopyRepository;
use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;
use Doctrine\ORM\EntityManager;
use Exception;

class MariaDBCopyRepository implements CopyRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findBy(Criteria $criteria): array
    {
        return $this->entityManager->getRepository(Copy::class)->findBy(
            $criteria->filters(),
            $criteria->orders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    public function getStockedCopiesOfMovie(MovieId $movieId): array
    {
        $query = $this->entityManager->createQuery(
            'SELECT c
            FROM \App\Netflix\Movies\Domain\Entity\Copy c
            JOIN c.movie m
            WHERE m.guid = :movieId
                AND c.stocked = TRUE'
        );
        $query->setParameter('movieId', $movieId->value());

        return $query->getResult();
    }

    public function save(Copy $copy): void
    {
        try {
            $this->entityManager->persist($copy);
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $e) {
            throw new UnableToPersist($e->getMessage(), $e->getCode(), $e);
        }
    }
}
