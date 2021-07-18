<?php

namespace App\Netflix\Movies\Application\Query;

final class GetStockedCopies
{
    private string $movieId;

    public function __construct(string $movieId)
    {
        $this->movieId = $movieId;
    }

    public function movieId(): string
    {
        return $this->movieId;
    }
}
