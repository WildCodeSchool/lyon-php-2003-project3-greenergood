<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('youpi@thegreenergood.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('Gus');
        $user->setLastname('Michel');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));
        $user->setStatus(1);
        $user->setPhone("0612345678");
        $user->setFonction("Membre bénévole");
        $user->setDescription("Pour laisser un monde meilleur à ses enfants, 
        Gus agit tant dans sa vie professionnelle, de par son rôle de référent RSE dans son entreprise, 
        que dans sa vie personnelle. Passionné de cuisine, il adore partager ses recettes!");
        $user->setGreenSkills1("Ateliers cuisine végétarienne et vegan");
        $user->setGreenSkills2("Référent de son quartier pour le composteur");
        $user->setGreenSkills3("Spécialiste en RSE");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('lucas.marguiron@gmail.com');
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setFirstname('Lucas');
        $user->setLastname('Marguiron');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));
        $user->setStatus(1);
        $user->setPhone("0778092304");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('elodie.girandier@thegreenergood.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Elodie');
        $user->setLastname('Girandier');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'elodie'
        ));
        $user->setStatus(1);
        $user->setPhone("0778092304");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('hello@thegreenergood.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Clémentine');
        $user->setLastname('Mossé');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'clementine'
        ));
        $user->setStatus(1);
        $user->setPhone("0615757954");
        $user->setFonction("Présidente");
        $user->setFacebook("https://www.facebook.com/profile.php?id=100013088252050");
        $user->setLinkedin("https://fr.linkedin.com/in/clémentine-mossé-1b864526");
        $user->setDescription("Clémentine est passionnée depuis plus de 10 ans par les questions d’écologie et
         d’actions individuelles. Afin de contribuer à son échelle à créer un monde plus beau et plus bio, elle s’est 
         lancé le défi un peu fou de créer une association et d’organiser des événements porteurs de messages, desquels 
         on ressort avec le sourire. En 2019, elle quitte son poste d'ingénieur pour se consacrer à The Greener Good. 
         \"Ensemble, construisons une société plus verte et plus heureuse");
        $user->setGreenSkills1("Atelier DIY pour lessive, déodorant et pastilles de lave-vaisselle.");
        $user->setGreenSkills2("Mode éthique");
        $user->setGreenSkills3("Conférence sur l’écoresponsabilité, la mode éthique et le voyage local");
        $manager->persist($user);

        $this->addReference('Lucas', $user);

        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $firstName = $faker->firstName;
            $lastname = $faker->lastName;
            $user->setEmail("$firstName.$lastname@gmail.com");
            $user->setFirstname($firstName);
            $user->setLastname($lastname);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'userpassword'
            ));
            $user->setFonction("Membre");
            $user->setStatus(1);
            $user->setPhone("0778092304");
            $manager->persist($user);
            $manager->flush();
        }
    }
}
