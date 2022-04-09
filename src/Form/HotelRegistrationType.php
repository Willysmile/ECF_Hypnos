<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
                'style' => 'width : 40%'  ]

            ])   ->add('address', TextType::class, [
                'label' => 'L’adresse est :',
                'disabled' => "true",
                'attr' => [
                    'class' => "form-control m-2 w-50 ",
                     ]


            ])

            ->add('imageFile', VichImageType::class,[
                'label' => 'Image en avant de l’hotel',
                'required' => false,
                'delete_label' => 'Suppression de l’image',
                'download_link' => false,
                'attr' => [
                    'class' => "form-control m-2 w-50 ",
                ]


            ])





            ->add('city', TextType::class, [
                'label' => 'La ville',
                'disabled' => "true",
                'attr' => [
                    'class' => "form-control m-2 w-50 "]

            ])


            ->add('description', TextareaType::class, [
                'label' => 'Description de l’établissement',
                'attr' => [
                    'class' => "form-control m-2 w-50 ",
                    'rows' => 8 ]

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
