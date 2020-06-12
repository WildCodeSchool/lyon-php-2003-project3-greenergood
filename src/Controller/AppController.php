<?php


namespace App\Controller;

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
     * @Route("/user", name="userIndex")
     */
    public function userIndex(): Response
    {
        return $this->render("user/index.html.twig");
    }
}
