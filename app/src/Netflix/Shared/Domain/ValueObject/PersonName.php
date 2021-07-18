<?php

namespace App\Netflix\Shared\Domain\ValueObject;

final class PersonName
{
    private string $firstName;
    private string $lastName;

    private function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function fromFirstAndLastName(string $firstName, string $lastName): self
    {
        return new self($firstName, $lastName);
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function value(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
