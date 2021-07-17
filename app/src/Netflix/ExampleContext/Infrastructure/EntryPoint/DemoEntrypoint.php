<?php

namespace App\Netflix\ExampleContext\Infrastructure\EntryPoint;

use Symfony\Component\HttpFoundation\JsonResponse;

class DemoEntrypoint
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'demo' => true,
        ]);
    }
}
