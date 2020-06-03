<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController {

    /**
     *@Route("/", name="app_index")
     */
    public function showFooter() : Response
    {
        return $this->render('testFooter.html.twig');
    }

}