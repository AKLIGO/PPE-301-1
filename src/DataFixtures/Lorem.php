<?php
// src/DataFixtures/Lorem.php

namespace App\DataFixtures;

use \DateTimeImmutable;

class Lorem
{
    public static function getRandomProductName()
    {
        $words = ['Apple', 'Banana', 'Orange', 'Grapes', 'Mango'];
        return $words[array_rand($words)];
    }

    public static function getRandomDescription()
    {
        $paragraphs = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
            'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.',
            'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ];
        return $paragraphs[array_rand($paragraphs)];
    }

    public static function getRandomPrice()
    {
        return rand(100, 1000) / 100;
    }

    public static function getRandomDate()
    {
        // Code pour générer un prix aléatoire
        // Utilisation de DateTimeImmutable
        return new DateTimeImmutable();
    }

    // Ajoutez d'autres fonctions pour générer des données fictives au besoin...
}
