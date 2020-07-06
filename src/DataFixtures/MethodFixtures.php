<?php


namespace App\DataFixtures;

use App\Entity\Method;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MethodFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $method = new Method();
            $method->setName($faker->domainWord);
            $method->setCreatedAt($faker->dateTime);
            $method->setPrerequisites($faker->sentence);
            $method->setContent($faker->text);
            $method->setActivated(true);
            $method->setPicture("https://www.thegreenergood.fr/wp-content/uploads/2018/08/logo-TGG-ombre.png");
            $manager->persist($method);
        }
        $manager->flush();
    }
}
