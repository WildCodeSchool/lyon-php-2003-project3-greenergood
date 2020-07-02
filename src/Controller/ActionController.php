<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\UserTeam;
use App\Form\ActionType;
use App\Form\UserTeamType;
use App\Repository\ActionRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\UserTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/action", name="action_")
 */
class ActionController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param ActionRepository $actionRepository
     * @return Response
     */
    public function index(ActionRepository $actionRepository): Response
    {
        return $this->render('action/index.html.twig', [
            'actions' => $actionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request) :Response
    {
        // Create a new Action instance
        $action = new Action();

        // Create a new Form related to the Action class
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        // Check if form is submitted and is valid
        // If yes, send the new Action instance to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            // When the SHOW method is coded, delete this line and uncomment the next two lines
            return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
            // Redirect to the page of the Action
            // return $this->redirectToRoute("action_show");
        }

        return $this->render('action/new.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET","POST"})
     * @param Action $action
     * @param TeamRepository $teamRepository
     * @return Response
     */
    public function show(Action $action, TeamRepository $teamRepository): Response
    {
        $deliverables = $action->getActionDeliverable();
        return $this->render('action/show.html.twig', [
            'action' => $action,
            'teams' => $teamRepository->findby(['action' => $action])
            'deliverables' => $deliverables,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Action $action
     * @return Response
     */
    public function edit(Request $request, Action $action): Response
    {
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
        }

        return $this->render('action/edit.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/deactivate", name="delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Action $action): Response
    {
        if ($this->isCsrfTokenValid('delete'.$action->getId(), $request->request->get('_token'))) {
            $action->setActivated(false);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
    }

    /**
     * @Route("/{id}/activate", name="activate")
     * @IsGranted("ROLE_ADMIN")
     */
    public function activate(Action $action): Response
    {
        $action->setActivated(true);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
    }

    // Duplicate action sheet

    /**
     * @Route("/{id}/duplicate", name="duplicate", methods={"GET","POST"})
     */
    public function duplicate(Request $request, Action $action): Response
    {
        $newaction = clone $action;
        $form = $this->createForm(ActionType::class, $newaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newaction);
            $entityManager->flush();

            return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
        }

        return $this->render('action/duplicate.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }
}
