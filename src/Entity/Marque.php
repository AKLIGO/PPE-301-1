<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $nom = null;

    #[ORM\Column(length: 12)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'marques')]
    private ?Articles $articlesMarque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getArticlesMarque(): ?Articles
    {
        return $this->articlesMarque;
    }

    public function setArticlesMarque(?Articles $articlesMarque): static
    {
        $this->articlesMarque = $articlesMarque;

        return $this;
    }
}
