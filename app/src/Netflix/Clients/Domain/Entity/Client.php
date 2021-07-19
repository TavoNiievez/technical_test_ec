<?php

namespace App\Netflix\Clients\Domain\Entity;

use App\Netflix\Clients\Domain\ValueObject\ClientId;
use App\Netflix\Clients\Domain\ValueObject\PhoneNumber;
use App\Netflix\Shared\Domain\ValueObject\Date;
use App\Netflix\Shared\Domain\ValueObject\Email;
use App\Netflix\Shared\Domain\ValueObject\Address;
use App\Netflix\Shared\Domain\ValueObject\PersonName;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client
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
    private string $guid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $phoneNumber;

    /**
     * @ORM\OneToOne(
     *     targetEntity="\App\Netflix\Shared\Domain\ValueObject\Address",
     *     mappedBy="client",
     *     cascade={"persist", "remove"}
     * )
     */
    private Address $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private ?DateTimeImmutable $birthdate;

    private function __construct(
        ClientId $id,
        PersonName $name,
        PhoneNumber $phoneNumber,
        Address $address,
        ?Email $email = null,
        ?Date $birthdate = null,
    ) {
        $address->_setClient($this);

        $this->guid = $id->value();
        $this->firstName = $name->firstName();
        $this->lastName = $name->lastName();
        $this->phoneNumber = $phoneNumber->value();
        $this->address = $address;
        $this->email = $email?->value();
        $this->birthdate = $birthdate?->value();
    }

    public static function create(
        ClientId $id,
        PersonName $name,
        PhoneNumber $phoneNumber,
        Address $address,
        ?Email $email = null,
        ?Date $birthdate = null,
    ): self {
        return new self($id, $name, $phoneNumber, $address, $email, $birthdate);
    }

    public function id(): ClientId
    {
        return ClientId::fromString($this->guid);
    }

    public function name(): PersonName
    {
        return PersonName::fromFirstAndLastName($this->firstName, $this->lastName);
    }

    public function phoneNumber(): PhoneNumber
    {
        return PhoneNumber::fromInt($this->phoneNumber);
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function email(): ?Email
    {
        if (is_null($this->email)) return null;
        return Email::fromString($this->email);
    }

    public function birthdate(): ?Date
    {
        if (is_null($this->birthdate)) return null;
        return Date::fromDateTime($this->birthdate);
    }
}
