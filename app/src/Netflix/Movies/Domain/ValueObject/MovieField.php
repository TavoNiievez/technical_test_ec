<?php

namespace App\Netflix\Movies\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use App\Netflix\Movies\Domain\Entity\Movie;

/**
 * @ORM\Entity
 */
class MovieField
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Netflix\Movies\Domain\Entity\Movie", inversedBy="translatableFields")
     */
    private Movie $movie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $value;

    public function __construct(Movie $movie, string $language, string $name, string $value)
    {
        $this->movie = $movie;
        $this->language = $language;
        $this->name = $name;
        $this->value = $value;
    }

    public function language(): string
    {
        return $this->language;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): string
    {
        return $this->value;
    }
}
