<?php

namespace App\Netflix\Movies\Domain\ValueObject;

use App\Netflix\Shared\Domain\ValueObject\Language;

final class MovieName
{
    private string $value;
    private string $language;

    private function __construct(string $value, string $language = Language::LANGUAGE_EN)
    {
        $this->value = $value;
        $this->language = $language;
    }

    public static function fromString(string $name, string $language = Language::LANGUAGE_EN): self
    {
        return new self($name, $language);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function language(): Language
    {
        return Language::fromString($this->language);
    }
}
