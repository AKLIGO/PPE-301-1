<?php

// src/EventListener/DoctrineTypesListener.php

namespace App\EventListener;

use App\Doctrine\Types\DateTimeImmmuatableType;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class DoctrineTypesListener
{
    public function registerCustomTypes(KernelEvent $event)
    {
        // Enregistrement du type personnalisé dans Doctrine
        Type::addType('datetime_immmuatable', DateTimeImmmuatableType::class);
    }
}
