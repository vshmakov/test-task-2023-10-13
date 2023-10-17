<?php

declare(strict_types=1);

namespace App\Tax;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(TaxDefinitionInterface::class)]
interface TaxDefinitionInterface
{
    public function getRegularExpression(): string;

    public function getValue(): float;
}
