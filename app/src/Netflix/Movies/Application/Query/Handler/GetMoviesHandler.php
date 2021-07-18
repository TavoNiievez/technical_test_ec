<?php

namespace App\Netflix\Movies\Application\Query\Handler;

use App\Netflix\Movies\Application\Query\GetMovies;
use App\Netflix\Movies\Application\View\MovieSimpleView;
use App\Netflix\Movies\Domain\Entity\Movie;
use App\Netflix\Movies\Domain\Repository\CopyRepository;
use App\Netflix\Movies\Domain\Repository\MovieRepository;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\ValueObject\Language;

class GetMoviesHandler
{
    private MovieRepository $movieRepository;
    private CopyRepository $copyRepository;

    public function __construct(MovieRepository $movieRepository, CopyRepository $copyRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->copyRepository = $copyRepository;
    }

    /**
     * @param GetMovies $query
     * @return MovieSimpleView[]
     */
    public function handle(GetMovies $query): array
    {
        $movies = $this->movieRepository->findBy(
            new Criteria(
                orders: ['year' => 'DESC'],
                limit: $query->limit(),
                offset: $query->offset()
            )
        );

        $english = Language::fromString(Language::LANGUAGE_EN);
        $movieViews = array_map(function (Movie $movie) use ($english) {
            $copies = $this->copyRepository->getStockedCopiesOfMovie($movie->id());
            return new MovieSimpleView(
                $movie->id()->value(),
                $movie->name($english)->value(),
                $movie->year()->value(),
                count($copies),
            );
        }, $movies);

        return $movieViews;
    }
}
