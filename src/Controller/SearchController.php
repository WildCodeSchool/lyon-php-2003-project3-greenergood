<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        /*$form = $this->createForm(
            SearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );*/

        return $this->render('_navbar.html.twig');
    }
}
