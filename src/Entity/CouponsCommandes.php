<?php

namespace App\Entity;

use App\Repository\CouponsCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsCommandesRepository::class)]
class CouponsCommandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'couponsCommandes')]
    private ?Coupons $coupons = null;

    #[ORM\ManyToOne(inversedBy: 'couponsCommandes')]
    private ?Commandes $commandes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoupons(): ?Coupons
    {
        return $this->coupons;
    }

    public function setCoupons(?Coupons $coupons): static
    {
        $this->coupons = $coupons;

        return $this;
    }

    public function getCommandes(): ?Commandes
    {
        return $this->commandes;
    }

    public function setCommandes(?Commandes $commandes): static
    {
        $this->commandes = $commandes;

        return $this;
    }
}
