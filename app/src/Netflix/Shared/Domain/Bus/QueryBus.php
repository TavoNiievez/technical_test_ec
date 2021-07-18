<?php

namespace App\Netflix\Shared\Domain\Bus;

interface QueryBus
{
    /**
     * @param object $query
     */
    public function handle($query);
}
