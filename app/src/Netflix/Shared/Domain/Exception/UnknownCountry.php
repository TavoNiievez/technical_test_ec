<?php

namespace App\Netflix\Shared\Domain\Exception;

use Exception;

class UnknownCountry extends Exception
{
    public function __construct(string $countryCode)
    {
        parent::__construct("Unknown country: " . $countryCode);
    }
}
