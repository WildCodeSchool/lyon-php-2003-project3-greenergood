<?php


namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class EventFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $event = new Event();
        $event->setName("Création de The Greener Good");
        $event->setStartDate(new DateTime("2016-01-01 00:00:00"));
        $event->setTarget("external");
        $manager->persist($event);

        $event = new Event();
        $event->setName("Première volontaire en Service Civique");
        $event->setStartDate(new DateTime("2018-01-01 00:00:00"));
        $event->setTarget("internal");
        $manager->persist($event);

        $event = new Event();
        $event->setName("Sortie de la carte interactive");
        $event->setStartDate(new DateTime("2018-11-10 00:00:00"));
        $event->setTarget("external");
        $manager->persist($event);

        $event = new Event();
        $event->setName("Premier Hall Green life au PDD");
        $event->setStartDate(new DateTime("2019-03-23 00:00:00"));
        $event->setStartDate(new DateTime("2019-03-24 00:00:00"));
        $event->setTarget("external");
        $manager->persist($event);

        $event = new Event();
        $event->setName("Premier salarié");
        $event->setStartDate(new DateTime("2019-03-23 00:00:00"));
        $event->setStartDate(new DateTime("2019-03-24 00:00:00"));
        $event->setTarget("internal");
        $manager->persist($event);

        $manager->flush();
    }
}
