<?php

declare(strict_types=1);

namespace App\Tax;

final class FranceTaxDefinition implements TaxDefinitionInterface
{
    public function getRegularExpression(): string
    {
        return '/^FR[a-zA-Z]{2}\d{9}$/';
    }

    public function getValue(): float
    {
        return 20.0;
    }
}
