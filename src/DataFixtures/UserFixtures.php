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
            $manager->persist($user);
            $manager->flush();
        }
    }
}
