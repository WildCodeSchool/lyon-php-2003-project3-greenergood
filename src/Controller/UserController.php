<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditEmailType;
use App\Form\EditPasswordType;
use App\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($user != $this->getUser()) {
            throw $this->createAccessDeniedException('Access denied');
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        $emailForm = $this->createForm(EditEmailType::class, $user);
        $emailForm->handleRequest($request);

        $passForm = $this->createForm(EditPasswordType::class, $user);
        $passForm->handleRequest($request);

        if ($passForm->isSubmitted() && $passForm->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $passForm->get('password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Votre mot de passe a été modifié avec succès");

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        if ($emailForm->isSubmitted() && $emailForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Votre email a été modifié avec succès");

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // Set the pictureFile property to null to avoid serialization error
            $user->setPictureFile(null);

            $this->addFlash('success', "Votre profil a été modifié avec succès");

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'passForm' => $passForm->createView(),
            'emailForm' => $emailForm->createView(),
            'form' => $form->createView(),
        ]);
    }
}
