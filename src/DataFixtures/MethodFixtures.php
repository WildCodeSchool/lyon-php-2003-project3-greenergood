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
            $manager->persist($method);
        }
        $manager->flush();
    }
}
