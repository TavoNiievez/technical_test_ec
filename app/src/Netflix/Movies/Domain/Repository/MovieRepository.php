<?php

namespace App\Netflix\Movies\Domain\Repository;

use App\Netflix\Movies\Domain\Entity\Movie;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;

interface MovieRepository
{
    /**
     * @param Criteria $criteria
     * @return Movie[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param Movie $movie
     * @throws UnableToPersist
     * @return void
     */
    public function save(Movie $movie): void;
}
