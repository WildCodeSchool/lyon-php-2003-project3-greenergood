<?php

namespace App\Form;

use App\Entity\Event;
use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de l'évènement *"])
            ->add('startDate', DateType::class, [
                'label' => "Date de début",
                'format' => 'dd MM yyyy',
                "data" => new DateTime(),
            ])
            ->add('endDate', DateType::class, [
                'label' => "Date de fin",
                'placeholder' => "",
                'format' => 'dd MM yyyy',
                'required'   => false,
            ])
            ->add('description', null, ['label' => "Description"])
            ->add('target', ChoiceType::class, [
                'choices' => [
                    'Evènement grand public' => 'external',
                    'Evènement interne' => 'internal',
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
