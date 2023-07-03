<?php

namespace App\Entity;

use App\Repository\DetaileCommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetaileCommandesRepository::class)]
class DetaileCommandes
{

    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    // private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?int $prix = null;


    #[ORM\Id]

    #[ORM\ManyToOne(inversedBy: 'detaileCommandes')]
    private ?Commandes $commandes = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'detaileCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $articles = null;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }


    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

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

    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): static
    {
        $this->articles = $articles;

        return $this;
    }
}
