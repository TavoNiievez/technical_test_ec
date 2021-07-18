<?php

namespace App\Netflix\Movies\Application\Query\Handler;

use App\Netflix\Movies\Application\Query\GetStockedCopies;
use App\Netflix\Movies\Domain\Entity\Movie;
use App\Netflix\Movies\Domain\Repository\MovieRepository;
use App\Netflix\Shared\Domain\Criteria\Criteria;

class GetStockedCopiesHandler
{
    private MovieRepository $repository;

    public function __construct(
        MovieRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param GetStockedCopies $query
     * @return Movie[]
     */
    public function handle(GetStockedCopies $query): array
    {
        return $this->repository->findBy(
            new Criteria(
                filters: [
                    'guid' => $query->movieId(),
                    ''
                ],
            )
        );
    }
}