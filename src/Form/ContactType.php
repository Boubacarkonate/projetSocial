<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class, [
            'label' => "Nom", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ])
        ->add('firstname', TextType::class, [
            'label' => "Prénom", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ]) 
        ->add('email',EmailType::class, [
            'label' => "Email", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ])
        ->add('telephone', TextType::class, [
            'label' => "Téléphone", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ])
        ->add('objet', TextType::class, [
            'label' => "Objet du message", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ])
        ->add('message', TextareaType::class, [
            'label' => "Message", 
           'attr' => [
               'class'=> 'form-control-lg'],
            ]) 
      
        ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
