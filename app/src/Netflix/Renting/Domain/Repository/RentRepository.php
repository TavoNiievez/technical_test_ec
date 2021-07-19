<?php

namespace App\Netflix\Renting\Domain\Repository;

use App\Netflix\Renting\Domain\Entity\Rent;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;

interface RentRepository
{
    /**
     * @param Criteria $criteria
     * @return Rent[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param Rent $rent
     * @throws UnableToPersist
     * @return void
     */
    public function save(Rent $rent): void;
}
