<?php

namespace App\Netflix\Renting\Infrastructure\EntryPoint;

use App\Netflix\Renting\Application\Exception\InvalidParameters;
use App\Netflix\Renting\Application\Query\CalculateCostOfRent;
use App\Netflix\Renting\Domain\Entity\Rent;
use App\Netflix\Shared\Domain\Bus\CommandBus;
use App\Netflix\Shared\Domain\Bus\QueryBus;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Netflix\Renting\Application\Command\RentMovies as RentMoviesCommand;

class RentMovies
{
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
    ): JsonResponse {
        try {
            $json = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => 'Unable to decode JSON'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $firstName = $json['firstName'] ?? null;
        $lastName = $json['lastName'] ?? null;
        $phoneNumber = $json['phoneNumber'] ?? null;
        $country = $json['address']['country'] ?? null;
        $zipCode = $json['address']['zipCode'] ?? null;
        $addressDetails = $json['address']['details'] ?? null;
        $email = $json['email'] ?? null;
        $birthdate = $json['birthdate'] ?? null;
        $movieIds = $json['movieIds'] ?? null;

        try {
            $command = new RentMoviesCommand(
                $firstName,
                $lastName,
                $phoneNumber,
                $country,
                $zipCode,
                $addressDetails,
                $email,
                $birthdate,
                $movieIds,
            );
            /** @var Rent $rent */
            $rent = $commandBus->handle($command);
        } catch (InvalidParameters $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse([
            'createdRentId' => $rent->id()->value(),
        ], Response::HTTP_CREATED);
    }
}
