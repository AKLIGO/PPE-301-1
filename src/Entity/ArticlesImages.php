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




    #[ORM\ManyToOne(targetEntity: Articles::class, inversedBy: "articlesImages")]
    #[ORM\JoinColumn(nullable: false)]

    private ?Articles $article = null;

    // ... autres méthodes et getters/setters





    #[ORM\ManyToOne(targetEntity: ArticlesImages::class, inversedBy: 'articlesImages')]
    private ?ArticlesImages $images = null;

    #[ORM\OneToMany(mappedBy: 'images', targetEntity: ArticlesImages::class)]
    private Collection $articlesImages;

    public function __construct()
    {
        $this->articlesImages = new ArrayCollection();
        // $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    // public function getArticlesImg(): ?Articles
    // {
    //     return $this->articles;
    // }

    // public function setArticlesImg(?Articles $articles): self
    // {
    //     $this->articles = $articles;
    //     return $this;
    // }


    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getImages(): ?ArticlesImages
    {
        return $this->images;
    }

    public function setImages(?ArticlesImages $images): self
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Collection<int, ArticlesImages>
     */
    public function getArticlesImages(): Collection
    {
        return $this->articlesImages;
    }

    public function addArticlesImage(ArticlesImages $articlesImage): self
    {
        if (!$this->articlesImages->contains($articlesImage)) {
            $this->articlesImages->add($articlesImage);
            $articlesImage->setImages($this);
        }
        return $this;
    }

    public function removeArticlesImage(ArticlesImages $articlesImage): self
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
