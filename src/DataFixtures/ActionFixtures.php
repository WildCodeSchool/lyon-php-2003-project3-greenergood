<?php


namespace App\DataFixtures;

use App\Entity\Action;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActionFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            $action = new Action();
            $action->setName($faker->sentence(2));
            $action->setEditionNumber($faker->randomDigitNotNull);
            $action->setDescription($faker->paragraph(3, true));
            $action->setStartDate(
                $faker->dateTimeBetween('-5 years', 'now', ull)
            );
            $manager->persist($action);
        }
        $manager->flush();
    }
}
