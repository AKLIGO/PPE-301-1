<?php

namespace App\Entity;

#use App\Doctrine\Types\DateTimeImmmuatableType;
use App\Entity\Trait\SlugTrait;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{

    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: type::class)]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setCategorie($this);
        }

        return $this;
    }

    public function removeType(type $type): static
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategorie() === $this) {
                $type->setCategorie(null);
            }
        }

        return $this;
    }
}
