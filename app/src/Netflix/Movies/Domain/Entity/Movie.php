<?php

namespace App\Netflix\Movies\Domain\Entity;

use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Movies\Domain\ValueObject\MovieName;
use App\Netflix\Shared\Domain\ValueObject\Language;
use App\Netflix\Shared\Domain\ValueObject\Year;
use App\Netflix\Movies\Domain\ValueObject\MovieField;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Movie
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
     * @ORM\OneToMany(
     *     targetEntity="\App\Netflix\Movies\Domain\ValueObject\MovieField",
     *     mappedBy="movie",
     *     cascade={"persist", "remove"}
     * )
     * @var Collection
     */
    private Collection $translatableFields;

    /**
     * @ORM\OneToMany(
     *     targetEntity="\App\Netflix\Movies\Domain\Entity\Copy",
     *     mappedBy="movie",
     *     cascade={"persist", "remove"}
     * )
     * @var Collection
     */
    private Collection $copies;

    /**
     * @ORM\Column(type="integer")
     */
    private int $year;

    private function __construct(MovieId $id, Year $year, MovieName $name)
    {
        $this->translatableFields = new ArrayCollection();
        $this->copies = new ArrayCollection();

        $this->guid = $id->value();
        $this->year = $year->value();
        $this->translatableFields->add(
            new MovieField($this, $name->language()->value(), 'name', $name->value())
        );
    }

    public static function create(MovieId $id, Year $year, MovieName $name)
    {
        return new self($id, $year, $name);
    }

    public function id(): MovieId
    {
        return MovieId::fromString($this->guid);
    }

    public function year(): Year
    {
        return Year::fromInt($this->year);
    }

    public function name(Language $language): MovieName
    {
        /** @var MovieField $field */
        $field = $this->translatableFields->filter(function (MovieField $field) use ($language) {
            return $field->name() === 'name' && $field->language() === $language->value();
        })->first();

        return MovieName::fromString($field->value(), $field->language());
    }
}
