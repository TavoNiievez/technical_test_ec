<?php

namespace App\Netflix\ExampleContext\Infrastructure\EntryPoint;

use App\Netflix\Clients\Domain\Entity\Client;
use App\Netflix\Clients\Domain\ValueObject\ClientId;
use App\Netflix\Clients\Domain\ValueObject\PhoneNumber;
use App\Netflix\ExampleContext\Application\Command\Example2;
use App\Netflix\ExampleContext\Application\Query\Example;
use App\Netflix\Movies\Domain\Entity\Copy;
use App\Netflix\Movies\Domain\Entity\Movie;
use App\Netflix\Movies\Domain\ValueObject\CopyId;
use App\Netflix\Movies\Domain\ValueObject\MovieFormat;
use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Movies\Domain\ValueObject\MovieName;
use App\Netflix\Renting\Domain\Entity\Rent;
use App\Netflix\Renting\Domain\ValueObject\RentId;
use App\Netflix\Renting\Domain\ValueObject\RentPrice;
use App\Netflix\Renting\Domain\ValueObject\RentState;
use App\Netflix\Shared\Domain\Bus\CommandBus;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use App\Netflix\Shared\Domain\ValueObject\Address;
use App\Netflix\Shared\Domain\ValueObject\Country;
use App\Netflix\Shared\Domain\ValueObject\Date;
use App\Netflix\Shared\Domain\ValueObject\Email;
use App\Netflix\Shared\Domain\ValueObject\Language;
use App\Netflix\Shared\Domain\ValueObject\PersonName;
use App\Netflix\Shared\Domain\ValueObject\Year;
use App\Netflix\Shared\Domain\ValueObject\ZipCode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class DemoEntrypoint
{
    public function __invoke(
        string $name,
        QueryBus $queryBus,
        CommandBus $commandBus,
        EntityManagerInterface $entityManager,
    ): JsonResponse {
        /** @var Movie $movie */
//        $movie = $entityManager->find(Movie::class, 3);
//
//        $copy = Copy::create(
//            CopyId::random(),
//            $movie,
//            Language::fromString(Language::LANGUAGE_EN),
//            MovieFormat::fromString(MovieFormat::FORMAT_DVD)
//        );
//        $client = Client::create(
//            ClientId::random(),
//            PersonName::fromFirstAndLastName('David', 'Blanco'),
//            PhoneNumber::fromInt(640125710),
//            Address::create(
//                Country::fromString(Country::COUNTRY_US),
//                ZipCode::fromString('03204'),
//                'Calle Falsa 123',
//            ),
//            Email::fromString('davidbc1997@gmail.com'),
//            Date::fromDateTime(new \DateTimeImmutable())
//        );

        $rent = Rent::create(
            RentId::random(),
            $entityManager->find(Client::class, 4),
            [$entityManager->find(Copy::class, 1), $entityManager->find(Copy::class, 2)],
            Date::fromDateTime(new \DateTimeImmutable()),
            Date::fromDateTime(new \DateTimeImmutable()),
            RentState::fromString(RentState::PROCESSING_DELIVERY),
            RentPrice::fromInt(599),
        );

        $entityManager->persist($rent);
        $entityManager->flush();

        return new JsonResponse([
            'guid' => $rent->id()->value(),
        ]);
    }
}
