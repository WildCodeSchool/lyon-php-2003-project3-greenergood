<?php

namespace App\Controller;

use App\Form\SearchType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search", methods={"GET","POST"})
     * @param Request $request
     */
    public function searchBar(Request $request) :Response
    {
        $form = $this->createForm(
            SearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        return $this->render('search/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
