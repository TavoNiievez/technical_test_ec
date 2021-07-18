<?php

namespace App\Netflix\Shared\Domain\ValueObject;

class Year
{
    private int $value;

    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $year): static
    {
        return new self($year);
    }

    public function value(): int
    {
        return $this->value;
    }
}
