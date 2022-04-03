<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            AssociationField::new('manager', 'Manager'),
        ];
    }

}
