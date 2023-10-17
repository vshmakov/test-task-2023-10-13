<?php

declare(strict_types=1);

namespace App\Tax;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class TaxDefinitionProvider
{
    public function __construct(
        /** @var iterable<TaxDefinitionInterface> */
        #[TaggedIterator(TaxDefinitionInterface::class)] private iterable $definitions,
    ) {
    }

    public function getTaxDefinition(string $taxNumber): ?TaxDefinitionInterface
    {
        foreach ($this->definitions as $definition) {
            if (preg_match($definition->getRegularExpression(), $taxNumber)) {
                return $definition;
            }
        }

        return null;
    }
}
