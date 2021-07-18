<?php

namespace App\Netflix\Movies\Domain\Exception;

use Exception;

class UnknownMovieFormat extends Exception
{
    public function __construct(string $format)
    {
        parent::__construct("Unknown movie format: " . $format);
    }
}
