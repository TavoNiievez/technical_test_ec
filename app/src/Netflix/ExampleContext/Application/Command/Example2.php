<?php

namespace App\Netflix\ExampleContext\Application\Command;

class Example2
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
