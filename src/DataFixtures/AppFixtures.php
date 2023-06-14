<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comments;
use App\Entity\Product;
use App\Entity\User;
use Container3stCKLT\getSecurity_Command_UserPasswordEncoderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures  extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));




        $admin = new User;
        $admin->setEmail('admin@gmail.com');
        $hash = $this->encoder->encodePassword($admin, "password");
        $admin->setPassword($hash);
        $admin->setFullName($faker->name());
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();

        for ($u = 0; $u < 5; $u++) {
            $user = new User();
            $user->setEmail('maher' . $u . '@gmail.com');
            $hash = $this->encoder->encodePassword($user, "password" . $u);
            $user->setPassword($hash);
            $user->setFullName('Maher Saadi' . $u);
            $manager->persist($user);
            $manager->flush();
        }

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
        for ($p = 0; $p < 4; $p++) {
            $comment = new Comments;
            $comment->setComment($faker->paragraph(4, true))
                ->setCreatedAt($faker->dateTimeBetween('-2 years', 'now', null))
                ->setProduct($product)
                ->setUser($user);


            $manager->persist($comment);
        }

        $manager->flush();
    }
}
