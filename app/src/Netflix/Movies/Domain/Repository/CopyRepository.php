<?php

namespace App\Netflix\Movies\Domain\Repository;

use App\Netflix\Movies\Domain\Entity\Copy;
use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;

interface CopyRepository
{
    /**
     * @param Criteria $criteria
     * @return Copy[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param MovieId $movieId
     * @return Copy[]
     */
    public function getStockedCopiesOfMovie(MovieId $movieId): array;

    /**
     * @param Copy $copy
     * @throws UnableToPersist
     * @return void
     */
    public function save(Copy $copy): void;
}