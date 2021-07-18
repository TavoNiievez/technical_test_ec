<?php

namespace App\Netflix\Shared\Domain\ValueObject;

use App\Netflix\Shared\Domain\Exception\UnknownLanguage;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Language
{
    public const LANGUAGE_EN = 'EN';
    private const LANGUAGES = [
        self::LANGUAGE_EN
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
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
