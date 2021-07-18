<?php

namespace App\Netflix\Movies\Domain\Entity;

use App\Netflix\Movies\Domain\ValueObject\CopyId;
use App\Netflix\Movies\Domain\ValueObject\MovieFormat;
use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Shared\Domain\ValueObject\Language;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Copy
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
     * @ORM\ManyToOne(targetEntity="\App\Netflix\Movies\Domain\Entity\Movie", inversedBy="copies")
     */
    private Movie $movie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $format;

    private function __construct(CopyId $id, Movie $movie, Language $language, MovieFormat $format)
    {
        $this->guid = $id->value();
        $this->movie = $movie;
        $this->language = $language->value();
        $this->format = $format->value();
    }

    public static function create(CopyId $id, Movie $movie, Language $language, MovieFormat $format)
    {
        return new self($id, $movie, $language, $format);
    }

    public function id(): CopyId
    {
        return CopyId::fromString($this->guid);
    }

    public function movie(): MovieId
    {
        return $this->movie->id();
    }

    public function language(): Language
    {
        return Language::fromString($this->language);
    }

    public function format(): MovieFormat
    {
        return MovieFormat::fromString($this->format);
    }
}
