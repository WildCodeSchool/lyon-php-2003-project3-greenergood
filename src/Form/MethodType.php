<?php

namespace App\Form;

use App\Entity\Method;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Method::class,
        ]);
    }
}
