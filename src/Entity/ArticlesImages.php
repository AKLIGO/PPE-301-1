<?php

namespace App\Entity;

use App\Repository\ArticlesImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesImagesRepository::class)]
class ArticlesImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 123)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'articlesImages')]
    private ?Articles $articlesImg = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'articlesImages')]
    private ?self $images = null;

    #[ORM\OneToMany(mappedBy: 'images', targetEntity: self::class)]
    private Collection $articlesImages;

    public function __construct()
    {
        $this->articlesImages = new ArrayCollection();
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

    public function getArticlesImg(): ?Articles
    {
        return $this->articlesImg;
    }

    public function setArticlesImg(?Articles $articlesImg): static
    {
        $this->articlesImg = $articlesImg;

        return $this;
    }

    public function getImages(): ?self
    {
        return $this->images;
    }

    public function setImages(?self $images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getArticlesImages(): Collection
    {
        return $this->articlesImages;
    }

    public function addArticlesImage(self $articlesImage): static
    {
        if (!$this->articlesImages->contains($articlesImage)) {
            $this->articlesImages->add($articlesImage);
            $articlesImage->setImages($this);
        }

        return $this;
    }

    public function removeArticlesImage(self $articlesImage): static
    {
        if ($this->articlesImages->removeElement($articlesImage)) {
            // set the owning side to null (unless already changed)
            if ($articlesImage->getImages() === $this) {
                $articlesImage->setImages(null);
            }
        }

        return $this;
    }
}
