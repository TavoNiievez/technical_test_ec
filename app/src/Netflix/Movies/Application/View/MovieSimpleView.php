<?php

namespace App\Netflix\Movies\Application\View;

class MovieSimpleView
{
    private string $id;
    private string $title;
    private int $year;
    private int $stockedCount;

    public function __construct(string $movieId, string $title, int $year, int $stockedCount)
    {
        $this->id = $movieId;
        $this->title = $title;
        $this->year = $year;
        $this->stockedCount = $stockedCount;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'stockedCount' => $this->stockedCount,
        ];
    }
}