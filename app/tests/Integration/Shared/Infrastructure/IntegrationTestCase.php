<?php

namespace App\Tests\Integration\Shared\Infrastructure;

use App\Tests\Integration\Shared\Domain\FixtureLoader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class IntegrationTestCase extends KernelTestCase
{
    private FixtureLoader $fixtureLoader;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
        $this->fixtureLoader = $this->service(FixtureLoader::class);
        parent::setUp();
    }

    /**
     * @param $id
     * @return object|null
     */
    protected function service($id): ?object
    {
        return self::getContainer()->get($id);
    }

    protected function loadFixtures()
    {
        $this->fixtureLoader->loadFixtures();
    }

    protected function purge()
    {
        $this->fixtureLoader->purge();
    }
}