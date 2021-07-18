<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use App\Netflix\Shared\Domain\Exception\UnknownLanguage;

final class Language
{
    public const LANGUAGE_EN = 'EN';
    private const LANGUAGES = [
        self::LANGUAGE_EN
    ];

    /**
     * @var string ISO 639-1 code
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
     * @throws UnknownLanguage
     */
    public static function fromString(string $code): self
    {
        if (!in_array($code, self::LANGUAGES)) {
            throw new UnknownLanguage($code);
        }

        return new self($code);
    }
}
