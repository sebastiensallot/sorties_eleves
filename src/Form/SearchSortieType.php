<?php

namespace App\Form;

use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', EntityType::class, [
                'class'=>Campus::class,
                'label'=>'Choix du campus:',
                'choice_label'=>'nom_campus',
                'placeholder'=>'Sélectionnez un campus'
            ])
            ->add('recherche', SearchType::class, [
                'label'=>'Recherchez une sortie :',
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Recherchez une sortie par mots clés'
                ],
                'required' => false
            ])
            ->add('dateDebut',DateType::class, [
                'label'=>'Entre :',
                'format'=>'dd-MM-yyyy',
                'placeholder'=>['year'=>'Année', 'month'=>'Mois', 'day'=>'Jours']
            ])
            ->add('dateCloture',DateType::class, [
                'label'=>'Et :',
                'format'=>'dd-MM-yyyy',
                'placeholder'=>['year'=>'Année', 'month'=>'Mois', 'day'=>'Jours']
            ])
            ->add('checkbox1', CheckboxType::class, [
                'label'=>'Sorties dont je suis l\'organisateur/rice'
    ])
            ->add('checkbox2', CheckboxType::class, [
                'label'=>'Sorties auxquelles je suis inscrit/e'
            ])
            ->add('checkbox3', CheckboxType::class, [
                'label'=>'Sorties auxquelles je ne suis pas inscrit/e'
            ])
            ->add('checkbox4', CheckboxType::class, [
                'label'=>'Sorties passées'
            ])
            ->add('Rechercher', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
