<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Method;
use App\Form\ActionType;
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
     * @param MethodRepository $methodRepository
     * @return Response
     */
    public function index(MethodRepository $methodRepository): Response
    {
        return $this->render('method/index.html.twig', [
            'methods' => $methodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="method_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
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

            return $this->redirectToRoute("method_index");
        }

        return $this->render('method/new.html.twig', [
            'method' => $method,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_show", methods={"GET"})
     * @param Method $method
     * @return Response
     */
    public function show(Method $method): Response
    {
        return $this->render('method/index.html.twig', [
            'method' => $method,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="method_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Method $method
     * @return Response
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
     * @Route("/{id}/duplicate", name="method_duplicate", methods={"GET","POST"})
     */
    public function duplicate(Request $request, Method $method): Response
    {
        $newMethod = clone $method;
        $form = $this->createForm(MethodType::class, $newMethod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newMethod);
            $entityManager->flush();

            return $this->redirectToRoute('method_index');
        }

        return $this->render('action/duplicate.html.twig', [
            'method' => $method,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="method_delete", methods={"DELETE"})
     * @param Request $request
     * @param Method $method
     * @return Response
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
