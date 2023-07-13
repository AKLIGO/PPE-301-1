<?php

namespace App\Entity;

use App\Repository\DetailsCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsCommandesRepository::class)]
class DetailsCommandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixTotal = null;

    #[ORM\Column]
    private ?float $quantites = null;

    #[ORM\ManyToOne(inversedBy: 'detailsCommandes')]
    private ?Articles $articles = null;

    #[ORM\ManyToOne(inversedBy: 'detailsCommandes')]
    private ?Commandes $commandes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): static
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getQuantites(): ?float
    {
        return $this->quantites;
    }

    public function setQuantites(float $quantites): static
    {
        $this->quantites = $quantites;

        return $this;
    }

    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): static
    {
        $this->articles = $articles;

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
