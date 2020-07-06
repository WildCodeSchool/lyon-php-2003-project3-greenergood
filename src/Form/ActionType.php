<?php

namespace App\Form;

use App\Entity\Action;
use App\Entity\Method;
use App\Entity\ActionDeliverable;
use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('methods', EntityType::class, [
                'label' => 'Fiche(s) Méthode',
                'class' => Method::class,
                'choice_label' => function (Method $method) {
                    $label = $method->getId() . ' - ' . $method->getName();
                    return $label;
                },
                'expanded' => true,
                'multiple' => true,
                'by_reference'=> false,
            ])
            ->add('actionDeliverable', CollectionType::class, [
                'entry_type' => ActionDeliverableType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'delete_empty' => function (ActionDeliverable $actionDeliverable = null) {
                    return null === $actionDeliverable || empty($actionDeliverable->getLink());
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
