<?php

namespace App\Netflix\Shared\Infrastructure\Bus;

use App\Netflix\Shared\Domain\Bus\CommandBus;
use League\Tactician\CommandBus as LeagueTacticianCommandBus;

class TacticianCommandBus implements CommandBus
{
    /**
     * @var LeagueTacticianCommandBus
     */
    private LeagueTacticianCommandBus $commandBus;

    /**
     * @param LeagueTacticianCommandBus $commandBus
     */
    public function __construct(LeagueTacticianCommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function handle($query)
    {
        return $this->commandBus->handle($query);
    }
}
