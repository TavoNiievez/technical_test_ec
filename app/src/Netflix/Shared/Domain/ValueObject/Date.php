<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeInterface;

class Date
{
    private DateTimeImmutable $value;

    private function __construct(DateTimeInterface $value)
    {
        $this->value = DateTimeImmutable::createFromInterface($value);
    }

    public static function fromDateTime(DateTimeInterface $value): self
    {
        return new self($value);
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function toISO8601(): string
    {
        return $this->value->format(DateTimeInterface::ISO8601);
    }
}
