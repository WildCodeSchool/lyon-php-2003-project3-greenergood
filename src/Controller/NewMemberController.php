<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewMemberController extends AbstractController
{

    /**
     * @Route("/bienvenue", name="welcome")
     */
    public function index(UserRepository $userRepository): Response
    {
        $contacts = $userRepository->findWelcomeContacts();

        return $this->render("welcome.html.twig", [
            'contacts' => $contacts
        ]);
    }
}
