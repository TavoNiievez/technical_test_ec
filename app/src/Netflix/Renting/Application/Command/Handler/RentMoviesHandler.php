<?php

namespace App\Netflix\Renting\Application\Command\Handler;

use App\Netflix\Clients\Domain\Entity\Client;
use App\Netflix\Clients\Domain\Repository\ClientRepository;
use App\Netflix\Clients\Domain\ValueObject\ClientId;
use App\Netflix\Clients\Domain\ValueObject\PhoneNumber;
use App\Netflix\Movies\Domain\Entity\Copy;
use App\Netflix\Movies\Domain\Repository\CopyRepository;
use App\Netflix\Movies\Domain\ValueObject\MovieId;
use App\Netflix\Renting\Application\Command\RentMovies;
use App\Netflix\Renting\Application\Exception\EmptyStock;
use App\Netflix\Renting\Application\Query\CalculateCostOfRent;
use App\Netflix\Renting\Domain\Entity\Rent;
use App\Netflix\Renting\Domain\Repository\RentRepository;
use App\Netflix\Renting\Domain\ValueObject\RentId;
use App\Netflix\Renting\Domain\ValueObject\RentPrice;
use App\Netflix\Renting\Domain\ValueObject\RentState;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use App\Netflix\Shared\Domain\ValueObject\Address;
use App\Netflix\Shared\Domain\ValueObject\Country;
use App\Netflix\Shared\Domain\ValueObject\Date;
use App\Netflix\Shared\Domain\ValueObject\Email;
use App\Netflix\Shared\Domain\ValueObject\PersonName;
use App\Netflix\Shared\Domain\ValueObject\ZipCode;

class RentMoviesHandler
{
    private QueryBus $queryBus;
    private ClientRepository $clientRepository;
    private CopyRepository $copyRepository;
    private RentRepository $rentRepository;

    public function __construct(
        QueryBus $queryBus,
        ClientRepository $clientRepository,
        CopyRepository $copyRepository,
        RentRepository $rentRepository,
    ) {
        $this->queryBus = $queryBus;
        $this->clientRepository = $clientRepository;
        $this->copyRepository = $copyRepository;
        $this->rentRepository = $rentRepository;
    }

    public function handle(RentMovies $command): Rent
    {
        $client = Client::create(
            ClientId::random(),
            PersonName::fromFirstAndLastName(
                $command->firstName(),
                $command->lastName(),
            ),
            PhoneNumber::fromInt($command->phoneNumber()),
            Address::create(
                Country::fromString($command->country()),
                ZipCode::fromString($command->zipCode()),
                $command->addressDetails(),
            ),
            is_null($command->email()) ? null : Email::fromString($command->email()),
            is_null($command->birthdate()) ? null : Date::fromDateTime(
                \DateTime::createFromFormat('Y-m-d', $command->birthdate())
            ),
        );
        $this->clientRepository->save($client);

        /** @var Copy[] $copies */
        $copies = [];
        foreach ($command->movieIds() as $movieId) {
            $stockedCopies = $this->copyRepository->getStockedCopiesOfMovie(MovieId::fromString($movieId));
            if (count($stockedCopies) === 0) {
                throw new EmptyStock("No stock available for movie with id " . $movieId);
            }

            $copies[] = $stockedCopies[0];
        }

        $startDate = new \DateTimeImmutable();
        $endDate = $startDate->modify('+1 week');

        /** @var int $price */
        $price = $this->queryBus->handle(new CalculateCostOfRent($command->movieIds()));

        $rent = Rent::create(
            RentId::random(),
            $client,
            $copies,
            Date::fromDateTime($startDate),
            Date::fromDateTime($endDate),
            RentState::fromString(RentState::PROCESSING_DELIVERY),
            RentPrice::fromInt($price),
        );
        $this->rentRepository->save($rent);

        return $rent;
    }
}
