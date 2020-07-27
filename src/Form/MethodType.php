<?php

namespace App\Form;

use App\Entity\Category;
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
use Vich\UploaderBundle\Form\Type\VichFileType;

class MethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de la méthode *", 'empty_data' => ''])
            ->add('methodFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false, // True to display a delete checkbox
                'download_uri' => false, // True to display a link of the picture
                'label' => "Photo de la méthode",
                'attr' => ['placeholder' => 'Ajoutez votre photo ici']
            ])
            ->add('category', EntityType::class, [
                'label' => "Catégorie *",
                'class' => Category::class,
                'choice_label' => function (Category $category) {
                    return $category->getId() . ' - ' . $category->getName();
                },
                'required' => false,
                'placeholder' => 'Autre',
                'expanded' => false,
                'multiple' => false,
                'by_reference'=> true,
                ])
            ->add('prerequisites', CKEditorType::class, ['label' => "Données *", 'empty_data' => ''])
            ->add('content', CKEditorType::class, ['label' => "Procédure *", 'empty_data' => ''])
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
                'label' => "Contacts utiles",
                'choice_label' => function ($user) {
                    return $user->getFirstname() . ' ' . $user->getLastname();
                },
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Method::class,
        ]);
    }
}
