<?php

namespace App\Netflix\Renting\Infrastructure\Repository;

use App\Netflix\Movies\Domain\Repository\CopyRepository;
use App\Netflix\Renting\Domain\Entity\Rent;
use App\Netflix\Renting\Domain\Repository\RentRepository;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;
use Doctrine\ORM\EntityManager;

class MariaDBRentRepository implements RentRepository
{
    private EntityManager $entityManager;
    private CopyRepository $copyRepository;

    public function __construct(
        EntityManager $entityManager,
        CopyRepository $copyRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->copyRepository = $copyRepository;
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->entityManager->getRepository(Rent::class)->findBy(
            $criteria->filters(),
            $criteria->orders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    /**
     * @inheritDoc
     */
    public function save(Rent $rent): void
    {
        try {
            foreach ($rent->copies() as $copy) {
                $copy->rent();
                $this->copyRepository->save($copy);
            }
            $this->entityManager->persist($rent);
            $this->entityManager->flush($rent);
            $this->entityManager->clear();
        } catch (\Exception $e) {
            throw new UnableToPersist($e->getMessage(), $e->getCode(), $e);
        }
    }
}
