<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EditProfileUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'mapped' => false,
                'required' => false,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répétez le mot de passe'],
                'constraints' => [
                    new Length([
                        'min' => 12,
                        'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caractères.',
                        'max' => 4096,
                        'maxMessage' => 'Le mot de passe ne doit pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*\d)(?=.*[A-Z])(?=.*[@#$%])(?!.*(.)\1{2}).*[a-z]/m',
                        'message' => 'Le mot de passe doit comprendre au moins 1 Majuscule, 1 Chiffre, 1 Caractère spécial.'
                    ]),
                ],
            ])
            
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
                'required' => false,  // Ici required = false défini que ce champs n'est pas obligatoire pour valider la modification du profil
            ])
            ->add('Prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
            ])
            ->add('Adresse', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
            ])
            ->add('Tel', TelType::class, [
                'label' => 'Téléphone',
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôles',
                'required' => false,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true, // pour afficher comme des cases à cocher
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}