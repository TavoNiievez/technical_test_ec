<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use App\Netflix\Clients\Domain\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $addressDetails;

    /**
     * @ORM\OneToOne(targetEntity="\App\Netflix\Clients\Domain\Entity\Client", inversedBy="address")
     */
    private Client $client;

    public function _setClient(Client $client)
    {
        $this->client = $client;
    }

    private function __construct(Country $country, ZipCode $zipCode, string $addressDetails)
    {
        $this->country = $country->value();
        $this->zipCode = $zipCode->value();
        $this->addressDetails = $addressDetails;
    }

    public static function create(Country $country, ZipCode $zipCode, string $addressDetails): self
    {
        return new self($country, $zipCode, $addressDetails);
    }

    public function country(): Country
    {
        return Country::fromString($this->country);
    }

    public function zipCode(): ZipCode
    {
        return ZipCode::fromString($this->zipCode);
    }

    public function addressDetails(): string
    {
        return $this->addressDetails;
    }

    public function value(): string
    {
        return $this->addressDetails . ', ' . $this->zipCode()->value() . ', ' . $this->country()->value();
    }
}
