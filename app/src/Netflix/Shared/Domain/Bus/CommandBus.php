<?php

namespace App\Netflix\Shared\Domain\Bus;

interface CommandBus
{
    /**
     * @param object $command
     */
    public function handle($command);
}
