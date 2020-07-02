<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DateTime;

class UserType extends AbstractType
{
    public function emailForm(FormBuilderInterface $builder, array  $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => "E-mail *"]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Super admin' => 'ROLE_SUPER_ADMIN',
                ],
                'label' => "Role *"
            ])
            ->add('firstname', TextType::class, ['label' => "Prénom *"])
            ->add('lastname', TextType::class, ['label' => "Nom de famille *"])
            ->add('fonction', TextType::class, ['label' => "Fonction", 'required'   => false])
            ->add('entry_date', DateType::class, [
                'label' => "Date de début",
                'format' => 'dd MM yyyy',
                "data" => new DateTime(),
                'required' => false
            ])
            ->add('address', TextType::class, ['label' => "Adresse", 'required'   => false])
            ->add('description', TextType::class, ['label' => "Description", 'required'   => false])
            ->add('user_picture', TextType::class, ['label' => "Photo de profil", 'required'   => false])
            ->add('linkedin', TextType::class, ['label' => "LinkedIn", 'required'   => false])
            ->add('facebook', TextType::class, ['label' => "Facebook", 'required'   => false])
            ->add('status', ChoiceType::class, [
                    'choices' => [
                        'Actif' => 1,
                        'Inactif' => 0,
                    ]]);

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    // transform the array to a string
                    return $rolesAsArray[0];
                },
                function ($rolesAsString) {
                    // transform the string back to an array
                    return explode(', ', $rolesAsString);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
