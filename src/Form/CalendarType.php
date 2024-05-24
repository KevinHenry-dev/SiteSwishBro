<?php

namespace App\Form;

use App\Entity\Terrain;
use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Heure de début'
            ])
            
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Heure de fin'
            ])
            ->add('description')


            ->add('terrain', EntityType::class, [
                'class' => Terrain::class,
                'choices' => $options['terrains'],
                'choice_label' => 'Nom_tdb', // Nom de la propriété à afficher dans le choix
                'label' => 'Terrain',
                'required' => false,
                'placeholder' => 'Sélectionner un terrain',
            ])

            ->add('all_day', CheckboxType::class, [
                'label' => 'Toute la journée',
                'required' => false // case non obligatoire
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
            'terrains' => [],
        ]);
    }
}
