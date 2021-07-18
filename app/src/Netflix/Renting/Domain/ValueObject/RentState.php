<?php

namespace App\Netflix\Renting\Domain\ValueObject;

use App\Netflix\Renting\Domain\Exception\UnknownRentState;

final class RentState
{
    public const PROCESSING_DELIVERY = 'PROCESSING_DELIVERY';
    public const DELIVERING = 'DELIVERING';
    private const STATES = [
        self::PROCESSING_DELIVERY,
        self::DELIVERING
    ];

    /**
     * @var string
     */
    private string $state;

    /**
     * @param string $state
     */
    private function __construct(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return static
     * @throws UnknownRentState()
     */
    public static function fromString(string $state): self
    {
        if (!in_array($state, self::STATES)) {
            throw new UnknownRentState($state);
        }

        return new self($state);
    }
}
