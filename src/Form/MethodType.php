<?php

namespace App\Form;

use App\Entity\Method;
use App\Entity\MethodLink;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de la méthode *"])
            ->add('prerequisites', null, ['label' => "Données *"])
            ->add('content', null, ['label' => "Procédure *"])
            ->add('objectives', null, ['label' => "Objectifs"])
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Method::class,
        ]);
    }
}
