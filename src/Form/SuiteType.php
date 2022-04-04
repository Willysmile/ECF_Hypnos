<?php

namespace App\Form;

use App\Entity\Suite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la suite',
                'attr' => [
                    'class' => "form-control m-2 w-50",
                ]
            ])
            ->add('description', TextAreaType::class, [
                'label' => 'Description de la suite',
                'attr' => [
                    'class' => "form-control m-2 w-50",
                ]
            ])
            ->add('night_price', IntegerType::class, [
                'label' => 'Prix de la nuitée (€)',

                'attr' => [
                    'class' => "form-control m-2 w-25",
                ]
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => "form-control m-2 w-50",
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Suite::class,
        ]);
    }
}
