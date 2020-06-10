<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewBenevoleController
 * @Route("/newBenevole", name="newBenevole_")
 */
class NewBenevoleController extends AbstractController
{
    /**
     * @Route("/", name="show")
     */
    public function show(): Response
    {
        return $this->render("benevole/show.html.twig");
    }
}
