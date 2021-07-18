<?php

namespace App\Tests\Integration\Shared\Infrastructure;

use App\Netflix\ExampleContext\Infrastructure\Repository\MariaDBDemoRepository;
use App\Tests\Integration\ExampleContext\Infrastructure\DemoFixture;
use App\Tests\Integration\Shared\Domain\FixtureLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Purger\PurgerInterface;
use Doctrine\ORM\EntityManager;

class MariaDBFixtureLoader implements FixtureLoader
{
    private Loader $loader;
    private PurgerInterface $purger;
    private ORMExecutor $executor;
    private EntityManager $entityManager;

    public function __construct(
        EntityManager $entityManager,
        MariaDBDemoRepository $demoRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->loader = new Loader();
        $this->loader->addFixture(new DemoFixture($demoRepository));
        $this->purger = new ORMPurger();
        $this->executor = new ORMExecutor($this->entityManager, $this->purger);
    }

    public function loadFixtures()
    {
        $this->executor->execute($this->loader->getFixtures(), true);
    }

    public function purge()
    {
        $this->executor->purge();
    }
}