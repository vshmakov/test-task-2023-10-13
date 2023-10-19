<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Webmozart\Assert\Assert;

final readonly class EntityFinder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $entityClass
     *
     * @return T
     */
    public function requireEntity(string $entityClass, mixed $id): object
    {
        $entity = $this->entityManager->find($entityClass, $id);
        Assert::notNull($entity);

        return $entity;
    }
}
