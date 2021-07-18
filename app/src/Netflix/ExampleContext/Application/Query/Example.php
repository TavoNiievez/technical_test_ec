<?php

namespace App\Netflix\ExampleContext\Application\Query;

class Example
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
