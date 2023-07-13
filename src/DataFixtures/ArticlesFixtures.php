<?php
// src/DataFixtures/ArticlesFixtures.php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use \DateTime;
use App\DataFixtures\Lorem;
use App\Entity\Type;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture  implements DependentFixtureInterface

{
    private function generateSlug(string $title): string
    {
        // Remplacez les caractères spéciaux par des tirets et convertit en minuscules
        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(trim(strip_tags($title))));

        // Supprime les tirets en double
        $slug = preg_replace('/-+/', '-', $slug);

        // Supprime les tirets des bords du slug
        $slug = trim($slug, '-');

        return $slug;
    }

    public function load(ObjectManager $manager): void
    {
        $articles = [];
        for ($i = 1; $i <= 10; $i++) {

            $article = new Articles();
            $article->setNom(Lorem::getRandomProductName());
            $article->setDescription(Lorem::getRandomDescription());
            $article->setPrix(Lorem::getRandomPrice());
            $article->setStock(rand(0, 100));
            $article->setValid(true);
            $article->setCreatAt(Lorem::getRandomDate());

            // Générer le slug à partir du nom de l'article en utilisant la fonction personnalisée
            $slug = $this->generateSlug($article->getNom());
            $article->setSlug($slug);

            $type = $this->getReference('typ-' . rand(1, 2));
            $article->setType($type);
            // Set other properties and persist the object
            // ...
            $articles[] = $article;

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
            CategoriesFixtures::class,
            ArticlesImageFixtures::class,
            AppFixtures::class

        ];
    }
}
