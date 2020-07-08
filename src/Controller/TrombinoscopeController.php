<?php


namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrombinoscopeController
 * @Route("/trombinoscope", name="trombinoscope_")
 */
class TrombinoscopeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserRepository $userRepository) : Response
    {
        $users = $userRepository->findBy(['status' => 1]);

        return $this->render("trombinoscope/index.html.twig", [
            'users' => $users,
        ]);
    }
}
