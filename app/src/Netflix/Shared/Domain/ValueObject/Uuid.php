<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as UuidGenerator;

class Uuid
{
    private string $uuid;

    protected function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function random(): static
    {
        return new static(UuidGenerator::uuid4()->toString());
    }

    public static function fromString(string $uuid): static
    {
        return new static($uuid);
    }

    public function value(): string
    {
        return $this->uuid;
    }
}
