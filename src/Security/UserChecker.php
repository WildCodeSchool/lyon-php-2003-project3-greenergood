<?php


namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker extends AbstractController implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if ($user->getStatus() == false) {
            throw new AccountExpiredException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
    }
}
