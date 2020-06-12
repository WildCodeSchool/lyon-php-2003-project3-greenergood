<?php

namespace App\Form;

use App\Entity\Method;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cardNumber')
            ->add('createdAt')
            ->add('prerequisites')
            ->add('content')
            ->add('objectives')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Method::class,
        ]);
    }
}
