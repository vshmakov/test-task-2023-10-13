<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class EntityId extends Constraint
{
    public string $entityClass;

    public function __construct(mixed $options = null, array $groups = null, mixed $payload = null, string $entityClass = null)
    {
        if (null !== $entityClass) {
            $options['entityClass'] = $entityClass;
        }

        parent::__construct($options, $groups, $payload);
    }
}
