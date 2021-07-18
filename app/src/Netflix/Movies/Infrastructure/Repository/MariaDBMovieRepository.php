<?php

namespace App\Netflix\Movies\Infrastructure\Repository;

use App\Netflix\Movies\Domain\Entity\Movie;
use App\Netflix\Movies\Domain\Repository\MovieRepository;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;
use Doctrine\ORM\EntityManager;
use Exception;

class MariaDBMovieRepository implements MovieRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findBy(Criteria $criteria): array
    {
        return $this->entityManager->getRepository(Movie::class)->findBy(
            $criteria->filters(),
            $criteria->orders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    public function save(Movie $movie): void
    {
        try {
            $this->entityManager->persist($movie);
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $e) {
            throw new UnableToPersist($e->getMessage(), $e->getCode(), $e);
        }
    }
}