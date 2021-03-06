<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name', 'Nom de l’établissement'),
            TextEditorField::new('description','Description de l’établissement'),
            TextField::new('address', 'Adresse'),
            TextField::new('city', 'Ville'),
            ImageField::new('imageName', 'Image')
                ->onlyOnIndex()
                ->setBasePath('/images/hotel'),
            TextareaField::new('imageFile', 'Image', [
                'mapped' => false,])
                ->onlyOnForms()
                ->setFormType(VichImageType::class),

            AssociationField::new('manager', 'Manager'),

        ];
    }
   /* public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }*/
}
