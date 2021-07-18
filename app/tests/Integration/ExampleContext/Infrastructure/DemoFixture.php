<?php

namespace App\Tests\Integration\ExampleContext\Infrastructure;

use App\Netflix\ExampleContext\Domain\Entity\DemoEntity;
use App\Netflix\ExampleContext\Domain\Repository\DemoRepository;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DemoFixture implements FixtureInterface
{
    private DemoRepository $repository;

    public function __construct(DemoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $demo = new DemoEntity();
        $demo->setName('Nombre de fixture');

        $this->repository->save($demo);
    }
}