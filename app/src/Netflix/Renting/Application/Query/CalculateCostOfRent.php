<?php

namespace App\Netflix\Renting\Application\Query;

final class CalculateCostOfRent
{
    private array $movieIds;

    public function __construct(array $movieIds)
    {
        $this->movieIds = $movieIds;
    }

    public function movieIds(): array
    {
        return $this->movieIds;
    }
}
