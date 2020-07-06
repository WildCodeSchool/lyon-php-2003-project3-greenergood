<?php


namespace App\DataFixtures;

use App\Entity\Method;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MethodFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

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
            $method->setAuthor($this->getReference("Lucas"));
        }
        $manager->flush();
    }
}
