<?php

namespace App\Tests\Integration\ExampleContext\Domain\Repository;

use App\Netflix\ExampleContext\Domain\Entity\DemoEntity;
use App\Netflix\ExampleContext\Domain\Repository\DemoRepository;
use App\Tests\Integration\Shared\Infrastructure\IntegrationTestCase;

class DemoRepositoryTest extends IntegrationTestCase
{
    private DemoRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->service(DemoRepository::class);
        $this->purge();
        $this->loadFixtures();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->purge();
    }

    public function testGetFromFixture()
    {
        $demo = $this->repository->findOneByName('Nombre de fixture');
        $this->assertInstanceOf(DemoEntity::class, $demo);
        $this->assertEquals('Nombre de fixture', $demo->getName());
    }
}