<?php

namespace App\Form;

use App\Entity\ActionDeliverable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionDeliverableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', null, ['label' => 'Url'])
            ->add('name', null, ['label' => 'Titre'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActionDeliverable::class,
        ]);
    }
}
