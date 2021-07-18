<?php

namespace App\Netflix\Renting\Domain\Exception;

use Exception;

class UnknownRentState extends Exception
{
    public function __construct(string $state)
    {
        parent::__construct("Unknown rent state: " . $state);
    }
}
