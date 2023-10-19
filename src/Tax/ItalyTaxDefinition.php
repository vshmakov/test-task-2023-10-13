<?php

declare(strict_types=1);

namespace App\Tax;

final readonly class ItalyTaxDefinition implements TaxDefinitionInterface
{
    public function getTaxNumberRegularExpression(): string
    {
        return '/^IT\d{11}$/';
    }

    public function getValue(): float
    {
        return 22.0;
    }
}
