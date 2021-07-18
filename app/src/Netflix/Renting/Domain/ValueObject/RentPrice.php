<?php

namespace App\Netflix\Renting\Domain\ValueObject;

use App\Netflix\Renting\Domain\Exception\NegativePrice;

final class RentPrice
{
    private int $priceInUSD;

    /**
     * @param int $priceInUSD
     * @throws NegativePrice
     */
    private function __construct(int $priceInUSD)
    {
        if ($priceInUSD < 0) {
            throw new NegativePrice();
        }

        $this->priceInUSD = $priceInUSD;
    }

    /**
     * @param int $priceInUSD
     * @return static
     * @throws NegativePrice
     */
    public static function fromInt(int $priceInUSD): self
    {
        return new self($priceInUSD);
    }

    public function value(): int
    {
        return $this->priceInUSD;
    }
}
