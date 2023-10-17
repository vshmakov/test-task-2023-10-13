<?php

declare(strict_types=1);

namespace App\Validator;

use App\Tax\TaxDefinitionProvider;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private TaxDefinitionProvider $taxDefinitionProvider,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        Assert::nullOrString($value);

        if (null === $value || '' === $value) {
            return;
        }

        $definition = $this->taxDefinitionProvider->getTaxDefinition($value);

        if (null !== $definition) {
            return;
        }

        $this->context->buildViolation('Unsupported tax number')
            ->addViolation()
        ;
    }
}
