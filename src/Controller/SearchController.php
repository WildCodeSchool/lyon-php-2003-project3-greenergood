<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SearchType;

use App\Repository\ActionRepository;
use App\Repository\MethodRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search", methods={"GET","POST"})
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function searchBar(Request $request, UserRepository $userRepository): Response
    {
        $form = $this->createForm(
            SearchType::class,
            null,
            [
                'method' => Request::METHOD_GET,
                'action' => $this->generateUrl('search_results')
            ]
        );
        $form->handleRequest($request);
        return $this->render('search/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/search/results" , name="search_results")
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ActionRepository $actionRepository
     * @param MethodRepository $methodRepository
     * @return Response
     */
    public function results(
        Request $request,
        UserRepository $userRepository,
        ActionRepository $actionRepository,
        MethodRepository $methodRepository
    ): Response {
        $form = $this->createForm(
            SearchType::class,
            null,
            [
                'method' => Request::METHOD_GET,
                'action' => $this->generateUrl('search_results')
            ]
        );
        $form->handleRequest($request);

        $results = ['users' => [], 'actions' => [], 'methods' => []];

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('search')->getData();
            $results['users'] = $userRepository->search($search);
            $results['actions'] = $actionRepository->search($search);
            $results['methods'] = $methodRepository->search($search);
        }
        return $this->render('search/results.html.twig', [
            'results' => $results,
        ]);
    }
}
