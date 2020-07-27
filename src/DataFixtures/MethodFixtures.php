<?php


namespace App\DataFixtures;

use App\Entity\Method;
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

        $method = new Method();
        $method->setName("TUTO SLACK");
        $method->setCreatedAt($faker->dateTime);
        $method->setPrerequisites("Nom de l’espace de travail TGG : thegreenergood.slack.com ");
        $method->setContent($faker->text);
        $method->setObjective1("Connaître les fonctions de base de Slack.");
        $method->setObjective2("Connaître les bonnes pratiques pour l’utilisation de Slack au sein de TGG.");
        $method->setActivated(true);
        $method->setAuthor($this->getReference("Lucas"));
        $manager->persist($method);

        for ($i = 1; $i < 25; $i++) {
            $method = new Method();
            $method->setName("Fiche méthode n°$i");
            $method->setCreatedAt($faker->dateTime);
            $method->setPrerequisites($faker->sentence);
            $method->setContent($faker->text);
            $method->setActivated(true);
            $method->setAuthor($this->getReference("Lucas"));
            $method->setCategory($this->getReference('category_' . random_int(0, 4)));
            $manager->persist($method);
        }
        $manager->flush();
    }
}
