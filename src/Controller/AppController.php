<?php


namespace App\Controller;

use App\Repository\ActionRepository;
use App\Repository\MethodRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="app_")
 */
class AppController extends AbstractController
{
    /**
     * @Route("/", name="homeIndex")
     */
    public function homeIndex(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/member", name="member_index")
     */
    public function memberIndex(): Response
    {
        return $this->render("member/index.html.twig");
    }

    /**
     * @Route("/index", name="index", methods={"GET"})
     * @param ActionRepository $actionRepository
     * @param MethodRepository $methodRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(
        ActionRepository $actionRepository, MethodRepository $methodRepository, UserRepository $userRepository
    )
    {
        return $this->render('index.html.twig', [
            'methods' => $methodRepository->findAll(),
            'actions' => $actionRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }
}
