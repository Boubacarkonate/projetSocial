<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
       
        ->add('company', TextType::class, [
            'required'=>false,
            'attr' => [
                'placeholder' => 'Si recruteur, nom de votre structure',
                'class' => 'form-control']
            ])
        ->add('name', TextType::class, [
            'attr' => [
            'placeholder' => 'Nom de famille',
            'class' => 'form-control']
            ]) 
        ->add('firstname', TextType::class,[
            'attr' => [
                'placeholder' => 'Prénom',
                'class' => 'form-control']
            ])
        ->add('phone', TextType::class, [
            'required'=>false,
            'attr' => [
                'placeholder' => 'Téléphone',
                'class' => 'form-control']
            ])
        ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control']
            ])
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
