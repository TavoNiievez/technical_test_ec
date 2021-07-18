<?php

namespace App\Netflix\Renting\Infrastructure\EntryPoint;

use App\Netflix\Renting\Application\Query\CalculateCostOfRent;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetCostOfRent
{
    public function __invoke(
        Request $request,
        QueryBus $queryBus,
    ): JsonResponse {
        $movieIds = $request->query->get('movieIds', null);
        $movieIds = !empty($movieIds) ? explode(',', $movieIds) : null;

        $query = new CalculateCostOfRent($movieIds ?? []);
        /** @var int $cost */
        $cost = $queryBus->handle($query);

        return new JsonResponse(
            $cost
        );
    }
}
