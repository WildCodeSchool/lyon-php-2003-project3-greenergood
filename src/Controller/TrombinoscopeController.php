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
     * @Route("/", name="show")
     */
    public function show() : Response
    {
        return $this->render("trombinoscope/show.html.twig");
    }
}
