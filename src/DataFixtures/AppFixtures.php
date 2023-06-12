<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures  extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        for ($c = 0; $c < 3; $c++) {
            $category = new Category;
            $category->setName($faker->department)
                ->setSlug($faker->slug());
            $manager->persist($category);
        }



        for ($p = 0; $p < 10; $p++) {
            $product = new Product;
            $product->setName($faker->productName())
                ->setPrice($faker->price(4000, 10000))
                ->setSlug($faker->slug())
                ->setPicture($faker->imageUrl(400, 400, true))
                ->setShortDesc($faker->paragraph())
                ->setCategory($category);

            $manager->persist($product);
        }
        $manager->flush();
    }
}
