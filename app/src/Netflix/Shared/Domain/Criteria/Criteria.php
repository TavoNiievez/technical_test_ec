<?php

namespace App\Netflix\Shared\Domain\Criteria;

class Criteria
{
    private array $filters;
    private array $orders;
    private int $limit;
    private int $offset;

    public function __construct(
        array $filters = [],
        array $orders = [],
        int $limit = 10,
        int $offset = 0,
    ) {
        $this->filters = $filters;
        $this->orders = $orders;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orders(): array
    {
        return $this->orders;
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
