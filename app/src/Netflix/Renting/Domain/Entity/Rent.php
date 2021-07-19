<?php

namespace App\Netflix\Renting\Domain\Entity;

use App\Netflix\Clients\Domain\Entity\Client;
use App\Netflix\Movies\Domain\Entity\Copy;
use App\Netflix\Renting\Domain\ValueObject\RentId;
use App\Netflix\Renting\Domain\ValueObject\RentPrice;
use App\Netflix\Renting\Domain\ValueObject\RentState;
use App\Netflix\Shared\Domain\ValueObject\Date;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Rent
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
     * @ORM\ManyToOne(targetEntity="\App\Netflix\Clients\Domain\Entity\Client", cascade={"persist", "remove"})
     */
    private Client $client;

    /**
     * @ORM\ManyToMany(targetEntity="\App\Netflix\Movies\Domain\Entity\Copy", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="rent_copies",
     *     joinColumns={@ORM\JoinColumn(name="rent_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="copy_id", referencedColumnName="id")}
     * )
     * @var Collection
     */
    private Collection $copies;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private DateTimeImmutable $startDate;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private DateTimeImmutable $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $state;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @param RentId $id
     * @param Client $client
     * @param Copy[] $copies
     * @param Date $startDate
     * @param Date $endDate
     * @param RentState $state
     * @param RentPrice $price
     */
    private function __construct(
        RentId $id,
        Client $client,
        array $copies,
        Date $startDate,
        Date $endDate,
        RentState $state,
        RentPrice $price,
    ) {
        $this->copies = new ArrayCollection($copies);

        $this->guid = $id->value();
        $this->client = $client;
        $this->startDate = $startDate->value();
        $this->endDate = $endDate->value();
        $this->state = $state->value();
        $this->price = $price->value();
    }

    public static function create(
        RentId $id,
        Client $client,
        array $copies,
        Date $startDate,
        Date $endDate,
        RentState $state,
        RentPrice $price,
    ): self {
        return new self($id, $client, $copies, $startDate, $endDate, $state, $price);
    }

    public function id(): RentId
    {
        return RentId::fromString($this->guid);
    }

    public function client(): Client
    {
        return $this->client;
    }

    /**
     * @return Copy[]
     */
    public function copies(): array
    {
        return $this->copies->toArray();
    }

    public function startDate(): Date
    {
        return Date::fromDateTime($this->startDate);
    }

    public function endDate(): Date
    {
        return Date::fromDateTime($this->endDate);
    }

    public function state(): RentState
    {
        return RentState::fromString($this->state);
    }

    public function price(): RentPrice
    {
        return RentPrice::fromInt($this->price);
    }
}
