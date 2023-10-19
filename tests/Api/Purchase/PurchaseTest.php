<?php

declare(strict_types=1);

namespace App\Tests\Api\Purchase;

use App\DataFixtures\CouponFixtures;
use App\DataFixtures\ProductFixtures;
use App\Entity\Product;
use App\Enums\HttpMethod;
use App\Enums\PaymentProcessor;
use App\Tests\Api\ActionTest;

final class PurchaseTest extends ActionTest
{
    private Product $product;

    protected function prepareData(): void
    {
        $this->product = $this->requireOneBy(Product::class, ['title' => ProductFixtures::IPHONE_TITLE]);
    }

    protected function getUrl(): string
    {
        return '/api/purchase';
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getBody(): ?array
    {
        return [
            'product' => $this->product->getId(),
            'taxNumber' => 'GR123456789',
            'couponCode' => CouponFixtures::AMOUNT_COUPON_CODE,
            'paymentProcessor' => PaymentProcessor::STRIPE->value,
        ];
    }
}
