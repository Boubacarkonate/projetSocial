<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('roles', ChoiceType::class, [
                 'label' => "Choisissez votre espace :", 
                'attr' => [
                    'class'=> 'form-control-lg'],
                      //  ne fonctionne pas
                'choices' => [
                    'Recruteur' => "ROLE_USER_RECRUTEUR",
                    'Candidat' => "ROLE_USER_CANDIDAT",
                    'Admin' => "ROLE_ADMIN"
                ],
                'expanded' => false,
                'multiple' => true,
                'label' => 'Rôle'

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
                ] )
            ->add('company', TextType::class, [
                'required'=>false,
                'attr' => [
                    'placeholder' => 'Si recruteur',
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
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe de minimun 14 caractères',       //recommandation cnil
                    'class' => 'form-control',
                    'autocomplete' => 'new-password'],
                // 'constraints' => [
                //     new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/',
                //     "Doit contenir au minimum 14 caractères, dont 1 majuscule, 1 minuscule, 1 chiffre & 1 caractère spécial (@$!%*?&)")  //je ne vois pas le message
                // ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte que mes informations soient stockées dans la base de données de Mon Blog pour la gestion des commentaires. J\'ai bien noté qu\'en aucun cas ces données ne seront cédées à des tiers.',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
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
