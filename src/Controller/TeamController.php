<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\ActionRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/team")
 */
class TeamController extends AbstractController
{
    /**
     * @Route("/", name="team_index", methods={"GET"})
     * @param TeamRepository $teamRepository
     * @return Response
     */
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAllWithTeamsAndUsers()
        ]);
    }

    /**
     * @Route("/{id}/new", name="team_new")
     */
    public function new(Action $action, Request $request): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $team->setAction($action);
            $entityManager->persist($team);
            $entityManager->flush();

            $this->addFlash('success', "L'équipe a été créée avec succès");

            return $this->redirectToRoute('action_show', ['id' => $action->getId()]);
        }

        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_show", methods={"GET"})
     */
    public function show(Team $team): Response
    {
        return $this->render('team/show.html.twig', [
            'team' => $team,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="team_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Team $team
     * @return Response
     */
    public function edit(Request $request, Team $team, ActionRepository $actionRepository): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $action = $team->getAction();
            $actionId = $action ? $action->getId() : null;
            return $this->redirectToRoute('action_show', ['id' => $actionId]);
        }

        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Team $team): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($team);
            $entityManager->flush();
        }

        $this->addFlash('danger', "L'équipe a été supprimée avec succès");

        return $this->redirectToRoute('team_index');
    }
}
