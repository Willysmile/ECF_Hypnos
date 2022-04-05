<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Le nom de votre établissement est :',
                'disabled' => "true",
                'attr' => [
                'class' => "form-control m-2 ",
                'style' => 'width : 10%'  ]

            ])   ->add('address', TextType::class, [
                'label' => 'L’adresse est :',
                'disabled' => "true",
                'attr' => [
                    'class' => "form-control m-2 ",
                    'style' => 'width : 10%'  ]


            ])
            ->add('city', TextType::class, [
                'label' => 'La ville',
                'disabled' => "true",
                'attr' => [
                    'class' => "form-control m-2 ",
                    'style' => 'width : 10%'  ]

            ])


            ->add('description', TextareaType::class, [
                'label' => 'Description de l’établissement',
                'attr' => [
                    'class' => "form-control m-2 ",
                    'style' => 'width : 10%'  ]

                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour",
                'attr' => [
                    'class' => "btn btn-lg btn-primary m-3"
                ]

            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}