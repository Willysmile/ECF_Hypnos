<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Mon prénom',
                'required' => 'true',
                'attr' => [
                    'class' => "form-control m-2",
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Mon nom',
                'required' => 'true',
                'attr' => [
                    'class' => "form-control m-2",
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
                    'style' => "width : 50%"
                ]
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'Sujet du message',
                'choices' => [
                    '1' => 'a'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
