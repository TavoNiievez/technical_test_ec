<?php

namespace App\Netflix\ExampleContext\Domain\Repository;

use App\Netflix\ExampleContext\Domain\Entity\DemoEntity;
use App\Netflix\ExampleContext\Domain\Exception\UnableToPersist;

interface DemoRepository
{
    public function findOneByName(string $name): ?DemoEntity;

    /**
     * @param DemoEntity $demo
     * @throws UnableToPersist
     * @return void
     */
    public function save(DemoEntity $demo): void;
}
