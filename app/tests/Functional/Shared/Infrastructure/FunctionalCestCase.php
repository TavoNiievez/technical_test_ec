<?php

namespace App\Tests\Functional\Shared\Infrastructure;

use App\Tests\Integration\Shared\Domain\FixtureLoader;
use FunctionalTester;

abstract class FunctionalCestCase
{
    private FixtureLoader $fixtureLoader;

    protected function setUp(FunctionalTester $I)
    {
        $this->fixtureLoader = $I->grabService(FixtureLoader::class);
    }

    protected function purge()
    {
        $this->fixtureLoader->purge();
    }

    protected function loadFixtures()
    {
        $this->fixtureLoader->loadFixtures();
    }
}