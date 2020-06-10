<?php


namespace App\Controller;

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
    public function index() : Response
    {
        return $this->render("trombinoscope/index.html.twig");
    }
}
