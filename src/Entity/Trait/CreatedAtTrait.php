<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Type;

use App\Doctrine\Types\DateTimeImmutableType; // Assurez-vous que le chemin d'accès est correct

use Doctrine\ORM\Mapping as ORM;

trait CreatedAtTrait
{

    #[ORM\Column(type: DateTimeImmutableType::class, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $created_at; // Vous aviez également une petite erreur de nom de propriété, c'était "creat_at", mais le nom correct est "created_at"

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
