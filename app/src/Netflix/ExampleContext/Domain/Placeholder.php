<?php

declare(strict_types=1);

namespace App\Netflix\ExampleContext\Domain;

class Placeholder
{
    private int $example;

    public function __construct(int $example = 5)
    {
        $this->example = $example;
    }

    public function example(): int
    {
        return $this->example;
    }
}
