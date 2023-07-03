<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use Faker\Factory;


use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passworEncoder,
        private SluggerInterface $slugger
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@gmail.com');
        $admin->setNom('APPOH');
        $admin->setPrenom('Gabriel');
        $admin->setCodePostal('Avedji');
        $admin->setVille('Limousine');
        $admin->setPassword($this->passworEncoder->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for ($usr = 1; $usr <= 5; $usr++) {
            $user = new Users();
            $user->setEmail($faker->unique()->email);
            $user->setNom($faker->firstName);
            $user->setPrenom($faker->lastName);
            $user->setCodePostal($faker->postcode);
            $user->setVille($faker->city);
            $user->setPassword($this->passworEncoder->hashPassword($user, 'secret'));
            //$user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
