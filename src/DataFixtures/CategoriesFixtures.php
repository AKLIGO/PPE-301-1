<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;


class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $categorie = new Categorie();
        // $categorie->setNom('Informatique');
        // $categorie->setSlug('informatique');
        // $manager->persist($categorie);

        // $manager->flush();

        $categorie = new Categorie();
        $categorie->setNom('Informatique');
        $categorie->setSlug('informatique');
        $manager->persist($categorie);


        // Enregistrez la catégorie dans les références pour une utilisation ultérieure dans les fixtures pour l'entité Type
        $this->addReference('categorie-informatique', $categorie);


        $manager->flush();
    }
}
