<?php

namespace App\Netflix\Shared\Domain\Exception;

use Exception;

class UnknownLanguage extends Exception
{
    public function __construct(string $languageCode)
    {
        parent::__construct("Unknown language: " . $languageCode);
    }
}
