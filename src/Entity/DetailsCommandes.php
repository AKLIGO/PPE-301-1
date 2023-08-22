<?php

namespace App\Entity;

use App\Repository\DetailsCommandesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

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

    // #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    // private \DateTimeInterface $date_livraison;

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

    // public function getDateLivraison(): ?\DateTimeInterface
    // {
    //     return $this->date_livraison;
    // }

    // public function setDateLivraison(\DateTimeInterface $date_livraison): static
    // {
    //     $this->date_livraison = $date_livraison;

    //     return $this;
    // }


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
