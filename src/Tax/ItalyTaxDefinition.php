<?php

declare(strict_types=1);

namespace App\Tax;

final class ItalyTaxDefinition implements TaxDefinitionInterface
{
    public function getRegularExpression(): string
    {
        return '/^IT\d{11}$/';
    }

    public function getValue(): float
    {
        return 22.0;
    }
}
