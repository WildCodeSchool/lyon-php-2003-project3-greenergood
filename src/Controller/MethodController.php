<?php

namespace App\Controller;

use App\Entity\Method;
use App\Form\MethodType;
use App\Repository\MethodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/method")
 */
class MethodController extends AbstractController
{
    /**
     * @Route("/", name="method_index", methods={"GET"})
     */
    public function index(MethodRepository $methodRepository): Response
    {
        return $this->render('method/index.html.twig', [
            'methods' => $methodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="method_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $method = new Method();
        $method->setCreatedAt(new DateTime('now'));
        $form = $this->createForm(MethodType::class, $method);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($method);
            $entityManager->flush();

            // When the SHOW method is coded, delete this line and uncomment the next two lines
            return $this->redirectToRoute("method_new");
            // Redirect to the page of the new method
            // return $this->redirectToRoute("method_show");
        }

        return $this->render('method/new.html.twig', [
            'method' => $method,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_show", methods={"GET"})
     */
    public function show(Method $method): Response
    {
        return $this->render('method/show.html.twig', [
            'method' => $method,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="method_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Method $method): Response
    {
        $form = $this->createForm(MethodType::class, $method);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('method_index');
        }

        return $this->render('method/edit.html.twig', [
            'method' => $method,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Method $method): Response
    {
        if ($this->isCsrfTokenValid('delete'.$method->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($method);
            $entityManager->flush();
        }

        return $this->redirectToRoute('method_index');
    }
}
