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
        $manager->persist($user);

        $user = new User();
        $user->setEmail('elodie.girandier@thegreenergood.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Elodie');
        $user->setLastname('Girandier');
        $user->setUserPicture('img/bienvenue/profile-2.jpg');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'elodie'
        ));
        $user->setStatus(1);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('hello@thegreenergood.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Clémentine');
        $user->setLastname('Mossé');
        $user->setUserPicture('img/bienvenue/profile-2.jpg');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'clementine'
        ));
        $user->setStatus(1);
        $manager->persist($user);

        $manager->flush();
    }
}
