<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Articles;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$articles =new Articles();
        //$manager->persist($articles);

        $manager->flush();
    }
}
