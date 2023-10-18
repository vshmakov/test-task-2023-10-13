<?php

declare(strict_types=1);

namespace App\Tax;

final class GermanyTaxDefinition implements TaxDefinitionInterface
{
    public function getTaxNumberRegularExpression(): string
    {
        return '/^DE\d{9}$/';
    }

    public function getValue(): float
    {
        return 19.0;
    }
}
