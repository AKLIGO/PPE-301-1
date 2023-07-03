<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Type;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class TypeFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $type = $this->createType('Ordinateur', 'informatique', 2, null, $manager);




        $categorie = $manager->getRepository(Categorie::class)->findOneBy(['nom' => 'Informatique']);
        // $type->setCategorie($categorie);

        $type = $this->createType('souris', 'informatique', true, $categorie, $manager);

        $type = $this->createType('Clavier', 'informatique', true, $categorie, $manager);

        // Enregistrez le type dans les références
        //$this->addReference('typ-' . $this->counter, $type);

        $manager->persist($type);
        $manager->flush();
    }

    public function createType(string $nom, string $slug, bool $isValid, ?Categorie $categorie, ObjectManager $manager): Type
    {
        $type = new Type();
        $type->setNom($nom);
        $type->setValid($isValid);
        $type->setSlug($this->slugger->slug($slug));
        $type->setCategorie($categorie);
        $manager->persist($type);

        $this->addReference('typ-' . $this->counter, $type);
        $this->counter++;
        return $type;
    }
    public function getDependencies(): array
    {
        return [

            CategoriesFixtures::class,

            AppFixtures::class

        ];
    }
}
