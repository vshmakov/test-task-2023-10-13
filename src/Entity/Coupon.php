<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enums\CouponType;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;
use Money\Money;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    #[ORM\Id]
    #[ORM\Column(length: 12)]
    private ?string $code = null;

    #[ORM\Column(length: 12, enumType: CouponType::class)]
    private ?CouponType $type = null;

    #[ORM\Column(type: 'eur', nullable: true)]
    private ?Money $amount = null;

    #[ORM\Column(type: 'decimal', precision: 9, scale: 2, nullable: true)]
    private ?float $percent = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getType(): ?CouponType
    {
        return $this->type;
    }

    public function setType(?CouponType $type): void
    {
        $this->type = $type;
    }

    public function getAmount(): ?Money
    {
        return $this->amount;
    }

    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    public function getPercent(): ?float
    {
        return $this->percent;
    }

    public function setPercent(?float $percent): void
    {
        $this->percent = $percent;
    }
}
