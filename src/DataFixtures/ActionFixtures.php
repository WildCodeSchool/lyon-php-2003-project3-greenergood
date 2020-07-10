<?php


namespace App\DataFixtures;

use App\Entity\Action;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Datetime;

class ActionFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $action = new Action();
        $action->setName("Balade mode éthique");
        $action->setEditionNumber(4);
        $action->setDescription(
            "Lors des balades mode éthique organisées par The Greener Good, une dizaine de participants 
            suivent un parcours entre quatre et six boutiques de vêtements et accessoires écoengagées de la Métropole 
            de Lyon. Cette balade est une manière originale de présenter aux curieux les alternatives durables qui 
            existent près de chez eux tout en permettant aux boutiques de présenter leur démarche. La balade se termine,
            pour celles et ceux qui le souhaitent, dans un café engagé pour discuter et échanger autour des alternatives
            découvertes.<br>
            Cette 4ème édition a lieu le 11 juillet 2020 de 13h30 à 17h avec un départ Rue de la République, 
            à proximité du métro “Cordeliers” (ligne A).<br><br>
            
            18/06/2020 : Validation du parcours<br>
            20/06/2020 : Début de la communication sur les réseaux sociaux<br>
            11/07/2020 : Jour J"
        );
        $action->setStartDate(
            new DateTime('2020-06-18')
        );
        $manager->persist($action);
        $manager->flush();
    }
}
