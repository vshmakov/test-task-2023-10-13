<?php

declare(strict_types=1);

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class EntityIdValidator extends ConstraintValidator
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param EntityId $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $entity = $this->entityManager
            ->find($constraint->entityClass, $value)
        ;

        if (null !== $entity) {
            return;
        }

        $this->context->buildViolation('Invalid identifier')
            ->addViolation()
        ;
    }
}
