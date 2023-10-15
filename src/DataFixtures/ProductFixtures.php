<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Money\Money;

final class ProductFixtures extends Fixture
{
    private const  PRODUCTS = [
        [
            'title' => 'Iphone',
            'price' => 100,
        ],
        [
            'title' => 'Наушники',
            'price' => 20,
        ],
        [
            'title' => 'Чехол',
            'price' => 10,
        ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $item) {
            $product = new Product();
            $product->setTitle($item['title']);
            $product->setPrice(Money::EUR($item['price']));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
