<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Money\Money;

final class EurType extends IntegerType
{
    public function getName(): string
    {
        return 'eur';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Money
    {
        $amount = parent::convertToPHPValue($value, $platform);

        if (null === $amount) {
            return null;
        }

        return Money::EUR($amount);
    }

    /**
     * @param Money|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        if (null === $value) {
            return null;
        }

        return (int) $value->getAmount();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
