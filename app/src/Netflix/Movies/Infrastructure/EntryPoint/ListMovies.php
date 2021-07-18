<?php

namespace App\Netflix\Movies\Infrastructure\EntryPoint;

use App\Netflix\Movies\Application\Query\GetMovies;
use App\Netflix\Movies\Application\View\MovieSimpleView;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListMovies
{
    public function __invoke(
        Request $request,
        QueryBus $queryBus,
    ): JsonResponse {
        $query = new GetMovies(
            $request->query->getInt('limit', 10),
            $request->query->getInt('offset', 0),
        );

        /** @var MovieSimpleView[] $movieViews */
        $movieViews = $queryBus->handle($query);

        return new JsonResponse(
            array_map(fn(MovieSimpleView $view) => $view->toArray(), $movieViews)
        );
    }
}
