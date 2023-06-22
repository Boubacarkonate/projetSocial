<?php

namespace App\Form\AdminForm;

use App\Entity\AnnonceEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminAnnonceEmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job', TextType::class, [
                'attr' => [
                    // 'placeholder' => 'Email',
                    'label' => 'Poste recherché',
                    'class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    // 'placeholder' => 'Email',
                    'label' => 'Description du poste',
                    'class' => 'form-control']
            ])
            ->add('localization', TextType::class, [
                'attr' => [
                    // 'placeholder' => 'Email',
                    'label' => 'Localisation',
                    'class' => 'form-control']
            ])
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnonceEmploi::class,
        ]);
    }
}
