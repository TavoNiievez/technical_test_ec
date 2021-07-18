<?php

namespace App\Netflix\ExampleContext\Infrastructure\EntryPoint;

use App\Netflix\ExampleContext\Application\Command\Example2;
use App\Netflix\ExampleContext\Application\Query\Example;
use App\Netflix\Shared\Domain\Bus\CommandBus;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class DemoEntrypoint
{
    public function __invoke(
        string $name,
        QueryBus $queryBus,
        CommandBus $commandBus,
    ): JsonResponse {
        $result = $queryBus->handle(new Example($name));
        $result2 = $commandBus->handle(new Example2($name));
        return new JsonResponse([
            'demo' => $result . $result2,
        ]);
    }
}
