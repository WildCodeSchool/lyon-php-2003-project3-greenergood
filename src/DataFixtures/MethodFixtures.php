<?php


namespace App\DataFixtures;

use App\Entity\Method;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MethodFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [UserFixtures::class, CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < 40; $i++) {
            $method = new Method();
            $method->setName($faker->sentence(2));
            $method->setCreatedAt($faker->dateTime);
            $method->setPrerequisites($faker->sentence);
            $method->setContent($faker->text);
            $method->setActivated(true);
            $method->setPicture("https://www.thegreenergood.fr/wp-content/uploads/2018/08/logo-TGG-ombre.png");
            $method->setAuthor($this->getReference("Lucas"));
            $method->setCategory($this->getReference('category_'.random_int(1, 15)));
            $manager->persist($method);
        }
        $manager->flush();
    }
}
