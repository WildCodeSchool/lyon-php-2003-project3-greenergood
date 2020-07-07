<?php

namespace App\Form;

use App\Entity\Method;
use App\Entity\MethodLink;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de la méthode *"])
            ->add('picture', TextType::class, ['label' => "Adresse de l'image :", 'required'   => false])
            ->add('prerequisites', CKEditorType::class, ['label' => "Données *"])
            ->add('content', CKEditorType::class, ['label' => "Procédure *"])
            ->add('objective1', null, ['label' => "Objectif 1 :"])
            ->add('objective2', null, ['label' => "Objectif 2 :"])
            ->add('objective3', null, ['label' => "Objectif 3 :"])
            ->add('methodLinks', CollectionType::class, [
                'entry_type' => MethodLinkType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'delete_empty' => function (MethodLink $methodLink = null) {
                    return null === $methodLink || empty($methodLink->getUrl());
                }
            ])
            ->add('contact', EntityType::class, [
                'class' => User::class,
                'label' => "Membres",
                'choice_label' => function ($user) {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Method::class,
        ]);
    }
}
