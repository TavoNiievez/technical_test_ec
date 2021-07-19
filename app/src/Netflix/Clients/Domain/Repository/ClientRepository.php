<?php

namespace App\Netflix\Clients\Domain\Repository;

use App\Netflix\Clients\Domain\Entity\Client;
use App\Netflix\Shared\Domain\Criteria\Criteria;
use App\Netflix\Shared\Domain\Exception\UnableToPersist;

interface ClientRepository
{
    /**
     * @param Criteria $criteria
     * @return Client[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @param Client $client
     * @throws UnableToPersist
     * @return void
     */
    public function save(Client $client): void;
}
