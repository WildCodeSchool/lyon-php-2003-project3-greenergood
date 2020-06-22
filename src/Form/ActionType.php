<?php

namespace App\Form;

use App\Entity\Action;
use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
            ->add('editionNumber', null, ['label' => "N° de l'édition"])
            ->add('actionPicture', null, ['label' => "Lien vers une photo"])
            ->add('description', CKEditorType::class, ['label' => "Description *"])
            ->add('startDate', DateType::class, [
                'label' => "Date de début",
                'format' => 'dd-MM--yyyy',
                "data" => new DateTime(),
            ])
            ->add('endDate', DateType::class, [
                'label' => "Date de fin",
                'placeholder' => "",
                'format' => 'dd-MM--yyyy',
                'required'   => false,
            ])
            ->add('location', null, ['label' => "Lieu"])
            ->add('content', null, ['label' => "Champ libre"])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'En cours' => 'started',
                    'Terminée' => 'ended',
                    'Annulée' => 'cancelled',
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
