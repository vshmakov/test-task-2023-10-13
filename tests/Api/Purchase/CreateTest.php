<?php

declare(strict_types=1);

namespace App\Tests\Api\Purchase;

use App\Entity\Product;
use App\Tests\Api\ActionTest;
use App\Tests\Api\HttpMethod;
use Money\Money;

final class CreateTest extends ActionTest
{
    private Product $product;

    protected function prepareData(): void
    {
        $this->product = new Product();
        $this->product->setTitle('Test product');
        $this->product->setPrice(Money::EUR(123));

        $entityManager = $this->getEntityManager();
        $entityManager->persist($this->product);
        $entityManager->flush();
    }

    protected function getUrl(): string
    {
        return '/api/purchase/';
    }

    protected function getMethod(): HttpMethod
    {
        return HttpMethod::POST;
    }

    protected function getBody(): ?array
    {
        return [
            'product' => $this->product->getId(),
        ];
    }
}
