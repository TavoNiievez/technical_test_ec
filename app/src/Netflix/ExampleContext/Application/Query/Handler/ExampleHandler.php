<?php

namespace App\Netflix\ExampleContext\Application\Query\Handler;

use App\Netflix\ExampleContext\Application\Query\Example;

class ExampleHandler
{
    public function handle(Example $query)
    {
        return $query->name;
    }
}
