<?php

namespace App\Netflix\Shared\Domain\ValueObject;

class ZipCode
{
    private string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $year): static
    {
        return new self($year);
    }

    public function value(): string
    {
        return $this->value;
    }
}
