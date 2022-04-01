<?php

namespace App\Controller\Admin;

use App\Entity\Manager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;


class ManagerCrudController extends AbstractCrudController
{private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }

    public static function getEntityFqcn(): string
    {
        return Manager::class;
    }


    public function configureFields(string $pageName): iterable
    {


        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email', 'E-mail')
                ->setFormType(EmailType::class)
                ->setFormTypeOptions([
                    'constraints' => new Length([
                        'min' => 5,
                        'max' => 60]),
                    'attr' => [
                        'placeholder' => "Merci de saisir l'email du Manager",

                    ]
                ]),
            TextField::new('firstname', 'Prénom du Manager'),
            TextField::new('lastname', 'Nom du Manager'),
            AssociationField::new('hotel', 'Établissement assigné'),



        ];

    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
           /* ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)*/
            ;
    }


}
