<?php

namespace App\Netflix\Movies\Domain\ValueObject;

use App\Netflix\Movies\Domain\Exception\UnknownMovieFormat;

final class MovieFormat
{
    public const FORMAT_DVD = 'DVD';
    private const FORMATS = [
        self::FORMAT_DVD
    ];

    private string $format;

    /**
     * @param string $format
     */
    private function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return static
     * @throws UnknownMovieFormat
     */
    public static function fromString(string $format): self
    {
        if (!in_array($format, self::FORMATS)) {
            throw new UnknownMovieFormat($format);
        }

        return new self($format);
    }
}
