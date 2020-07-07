<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $builder->getData();
        $firstName = $user->getFirstname();
        $lastName = $user->getLastname();

        $builder->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent correspondre.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options' => [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/"),
                    new Regex([
                        'match' => false,
                        'pattern' => "/($lastName|$firstName)/i",
                        'message' => "Votre mot de passe ne peut contenir ni votre nom, ni votre prénom"
                    ]),
                ],
                'label' => 'Nouveau mot de passe',
            ],
            'second_options' => ['label' => 'Répéter mot de passe'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
