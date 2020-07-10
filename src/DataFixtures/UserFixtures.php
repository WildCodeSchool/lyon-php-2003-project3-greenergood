<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
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
        $user->setPhone("0000000000");
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
        $user->setPhone("0000000000");
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
            $user->setEmail('test.test' . $i . '@gmail.com');
            $user->setFirstname("User$i");
            $user->setLastname("Lastname$i");
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'userpassword'
            ));
            $user->setStatus(1);
            $user->setPhone("0000000000");
            $manager->persist($user);
            $manager->flush();
        }
    }
}
