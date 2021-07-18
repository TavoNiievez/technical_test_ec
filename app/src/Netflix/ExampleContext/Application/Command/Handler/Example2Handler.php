<?php

namespace App\Netflix\ExampleContext\Application\Command\Handler;

use App\Netflix\ExampleContext\Application\Command\Example2;

class Example2Handler
{
    public function handle(Example2 $command)
    {
        return $command->name;
    }
}
