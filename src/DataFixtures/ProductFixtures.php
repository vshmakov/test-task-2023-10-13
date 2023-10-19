<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use App\Money\MoneyHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProductFixtures extends Fixture
{
    public const IPHONE_TITLE = 'Iphone';
    private const  PRODUCTS = [
        [
            'title' => self::IPHONE_TITLE,
            'price' => 100.0,
        ],
        [
            'title' => 'Наушники',
            'price' => 20.0,
        ],
        [
            'title' => 'Чехол',
            'price' => 10.0,
        ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $item) {
            $product = new Product();
            $product->setTitle($item['title']);
            $product->setPrice(MoneyHelper::floatToEur($item['price']));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
