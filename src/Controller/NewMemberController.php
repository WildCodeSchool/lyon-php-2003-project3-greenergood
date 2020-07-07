<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewMemberController extends AbstractController
{
    /**
     * @Route("/bienvenue", name="welcome")
     */
    public function index() : Response
    {

        return $this->render("welcome.html.twig");
    }
}
