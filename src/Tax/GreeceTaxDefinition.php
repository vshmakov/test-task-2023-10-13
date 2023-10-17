<?php

declare(strict_types=1);

namespace App\Tax;

final class GreeceTaxDefinition implements TaxDefinitionInterface
{
    public function getRegularExpression(): string
    {
        return '/^GR\d{9}$/';
    }

    public function getValue(): float
    {
        return 24.0;
    }
}
