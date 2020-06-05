<?php

namespace App\Form;

use App\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de l'action *"])
            ->add('editionNumber', null, ['label' => "N° de l'édition *"])
            ->add('actionPicture', null, ['label' => "Lien vers une photo"])
            ->add('description', null, ['label' => "Description *"])
            ->add('startDate', DateType::class, [
                'label' => "Date de début",
                'format' => 'dd-MM--yyyy',
            ])
            ->add('endDate', DateType::class, [
                'label' => "Date de fin",
                'placeholder' => "",
                'format' => 'dd-MM--yyyy',
                'required'   => false,
            ])
            ->add('location', null, ['label' => "Lieu"])
            ->add('content', null, ['label' => "Champs libre"])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                    'Annulé' => 'Annulé',
                ],
            ])
            ->add('projectProgress', null, ['label' => "Avancement du projet"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
