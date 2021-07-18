<?php

namespace App\Netflix\ExampleContext\Infrastructure\Repository;

use App\Netflix\ExampleContext\Domain\Entity\DemoEntity;
use App\Netflix\ExampleContext\Domain\Exception\UnableToPersist;
use App\Netflix\ExampleContext\Domain\Repository\DemoRepository;
use Doctrine\ORM\EntityManager;
use Exception;

class MariaDBDemoRepository implements DemoRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOneByName(string $name): ?DemoEntity
    {
        return $this->entityManager->getRepository(DemoEntity::class)->findOneBy([
            'name' => $name,
        ]);
    }

    /**
     * @param DemoEntity $demo
     * @throws UnableToPersist
     */
    public function save(DemoEntity $demo): void
    {
        try {
            $this->entityManager->persist($demo);
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $e) {
            throw new UnableToPersist($e->getMessage(), $e->getCode());
        }
    }
}
