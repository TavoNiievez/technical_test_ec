<?php

namespace App\Netflix\Clients\Domain\ValueObject;

final class PhoneNumber
{
    private int $phoneNumber;

    private function __construct(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public static function fromInt(int $phoneNumber): self
    {
        return new self($phoneNumber);
    }

    public function value(): int
    {
        return $this->phoneNumber;
    }
}
