<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use App\Netflix\Shared\Domain\Exception\UnknownCountry;

class Country
{
    public const COUNTRY_US = 'US';
    private const COUNTRIES = [
        self::COUNTRY_US
    ];

    /**
     * @var string
     */
    private string $code;

    /**
     * @param string $code
     */
    private function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return static
     * @throws UnknownCountry
     */
    public static function fromString(string $code): self
    {
        if (!in_array($code, self::COUNTRIES)) {
            throw new UnknownCountry($code);
        }

        return new self($code);
    }
}
