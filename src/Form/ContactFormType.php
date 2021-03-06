<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'required' => 'true',
                'attr' => [
                    'class' => "form-control m-2",
                    'placeholder' => "Merci de saisir votre nom",
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'required' => 'true',
                'attr' => [
                    'class' => "form-control m-2",
                    'placeholder' => "Merci de saisir votre prénom",
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => "Votre email",
                'required' => 'true',
                'constraints' => new Length([
                    'min' => 5,
                    'max' => 60]),
                'attr' => [
                    'placeholder' => "Merci de saisir votre email",
                    'class' => "form-control m-2",

                ]
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'Sujet de votre message',
                'choices' => [
                    'Je souhaite poser une réclamation' => 'Je souhaite poser une réclamation',
                    'Je souhaite commander un service supplémentaire' => 'Je souhaite commander un service supplémentaire',
                    'Je souhaite en savoir plus sur une suite' => 'Je souhaite en savoir plus sur une suite',
                    'J’ai un souci avec cette appli' => 'J’ai un souci avec cette appli'
                ],
                'attr' => [
                    'class' => "form-control m-2",

                ]])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'class' => "form-control m-2 ",
                    'rows' => 5
                ]


            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer votre message",
                'attr' => [
                    'class' => "btn btn-lg btn-secondary m-3"
                ]

            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
