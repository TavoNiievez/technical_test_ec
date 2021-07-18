<?php

namespace App\Netflix\Movies\Application\Query;

final class GetMovies
{
    private int $limit;
    private int $offset;

    public function __construct(int $limit, int $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function offset(): int
    {
        return $this->offset;
    }
}
