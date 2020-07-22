<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => "Prénom *", 'empty_data' => ''])
            ->add('lastname', TextType::class, ['label' => "Nom de famille *", 'empty_data' => ''])
            ->add('phone', TelType::class, [
                'label' => "Numéro de téléphone *",
                'required' => true,
                'constraints' => new Length(['min' => 10])
            ])
            ->add('fonction', TextType::class, ['label' => "Fonction", 'required' => false])
            ->add('address', TextType::class, ['label' => "Adresse", 'required' => false])
            ->add('description', TextareaType::class, ['label' => "Description", 'required' => false])
            ->add('pictureFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false, // True to display a delete checkbox
                'download_uri' => false, // True to display a link of the picture
                'label' => "Photo de profil",
                'attr'=>['placeholder'=>'Ajoutez votre photo ici']
            ])
            ->add('linkedin', TextType::class, ['label' => "LinkedIn", 'required' => false])
            ->add('facebook', TextType::class, ['label' => "Facebook", 'required' => false])
            ->add('greenSkills1', TextType::class, ['label' => "Green skills 1", 'required' => false])
            ->add('greenSkills2', TextType::class, ['label' => "Green skills 2", 'required' => false])
            ->add('greenSkills3', TextType::class, ['label' => "Green skills 3", 'required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
