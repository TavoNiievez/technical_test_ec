<?php

namespace App\Netflix\Renting\Application\Command;

use App\Netflix\Renting\Application\Exception\InvalidParameters;

final class RentMovies
{
    private string $firstName;
    private string $lastName;
    private int $phoneNumber;
    private string $country;
    private string $zipCode;
    private string $addressDetails;
    private ?string $email;
    private ?string $birthdate;
    private array $movieIds;

    public function __construct(
        $firstName,
        $lastName,
        $phoneNumber,
        $country,
        $zipCode,
        $addressDetails,
        $email,
        $birthdate,
        $movieIds,
    ) {
        $paramTypes = [
          'firstName' => [gettype('')],
          'lastName' => [gettype('')],
          'phoneNumber' => [gettype(0)],
          'country' => [gettype('')],
          'zipCode' => [gettype('')],
          'addressDetails' => [gettype('')],
          'email' => [gettype(''), gettype(null)],
          'birthdate' => [gettype(''), gettype(null)],
          'movieIds' => [gettype([])],
        ];

        foreach ($paramTypes as $paramName => $paramType) {
            if (!in_array(gettype($$paramName), $paramType)) {
                throw new InvalidParameters(
                    "Param " . $paramName . " must be of type " . implode(',', $paramType)
                    . ", but provided type is " . gettype($$paramName)
                );
            }
        }
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->country = $country;
        $this->zipCode = $zipCode;
        $this->addressDetails = $addressDetails;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->movieIds = $movieIds;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function phoneNumber(): int
    {
        return $this->phoneNumber;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function zipCode(): string
    {
        return $this->zipCode;
    }

    public function addressDetails(): string
    {
        return $this->addressDetails;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function birthdate(): ?string
    {
        return $this->birthdate;
    }

    public function movieIds(): array
    {
        return $this->movieIds;
    }
}
