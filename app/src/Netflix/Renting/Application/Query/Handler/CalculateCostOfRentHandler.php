<?php

namespace App\Netflix\Renting\Application\Query\Handler;

use App\Netflix\Movies\Domain\Repository\MovieRepository;
use App\Netflix\Renting\Application\Query\CalculateCostOfRent;
use App\Netflix\Shared\Domain\Criteria\Criteria;

class CalculateCostOfRentHandler
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function handle(CalculateCostOfRent $query): int
    {
        $movies = $this->movieRepository->findBy(
            new Criteria(
                filters: [
                    'guid' => $query->movieIds(),
                ]
            )
        );

        $finalCost = 0;
        foreach ($movies as $movie) {
            if ($movie->year()->value() === intval(date('Y'))) {
                $finalCost += 500;
            } else {
                $finalCost += 300;
            }
        }

        return $finalCost;
    }
}
