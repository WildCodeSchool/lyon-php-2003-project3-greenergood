<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => "Prénom *"])
            ->add('lastname', TextType::class, ['label' => "Nom de famille *"])
            ->add('fonction', TextType::class, ['label' => "Fonction", 'required' => false])
            ->add('address', TextType::class, ['label' => "Adresse", 'required' => false])
            ->add('description', TextareaType::class, ['label' => "Description", 'required' => false])
            ->add('user_picture', TextType::class, ['label' => "Photo de profil", 'required' => false])
            ->add('linkedin', TextType::class, ['label' => "LinkedIn", 'required' => false])
            ->add('facebook', TextType::class, ['label' => "Facebook", 'required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
