<?php

namespace App\Form;

use App\Entity\Suite;
use Doctrine\DBAL\Types\FloatType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class SuiteRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextField::class,[
                'label' => 'Nom de la suite',
                'attr' => [
                    'class' => "form-control m-2",
                ]
            ])
            ->add('description',TextAreaField::class,[
                'label' => 'Description de la suite',
                'attr' => [
                    'class' => "form-control m-2",
                ]
            ])
            ->add('night_price', FloatType::class, [
                'label' => 'Prix de la nuitée',
                'attr' => [
                    'class' => "form-control m-2",
                ]
            ])
            ->add('hotel')

            ->add('imageFile', VichImageType::class, [
                'label' => 'Image en avant de l’hotel',
                'required' => false,
                'delete_label' => 'Suppression de l’image',
                'download_link' => false,
                'attr' => [
                    'class' => "form-control m-2 w-50 ",
                ]]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Suite::class,
        ]);
    }
}
