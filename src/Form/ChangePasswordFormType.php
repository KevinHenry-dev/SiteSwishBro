<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
            'mapped' => false,
            'required' => false,
            'first_options'  => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Répétez le mot de passe'],
            'constraints' => [
                new Length([
                    'min' => 8,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}