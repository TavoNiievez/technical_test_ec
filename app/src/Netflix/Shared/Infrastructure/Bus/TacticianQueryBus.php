<?php

namespace App\Netflix\Shared\Infrastructure\Bus;

use App\Netflix\Shared\Domain\Bus\QueryBus;
use League\Tactician\CommandBus as LeagueTacticianCommandBus;

class TacticianQueryBus implements QueryBus
{
    /**
     * @var LeagueTacticianCommandBus
     */
    private LeagueTacticianCommandBus $queryBus;

    /**
     * @param LeagueTacticianCommandBus $queryBus
     */
    public function __construct(LeagueTacticianCommandBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function handle($query)
    {
        return $this->queryBus->handle($query);
    }
}
