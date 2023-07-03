<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Internal\SQLResultCasing;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $creat_at = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Type $Type = null;

    #[ORM\Column]
    private ?bool $valid = null;

    // #[ORM\OneToMany(mappedBy: 'articlesImg', targetEntity: ArticlesImages::class)]
    // private Collection $articlesImages;

    #[ORM\OneToMany(mappedBy: 'articlesImages', targetEntity: Marque::class)]
    private Collection $marques;

    #[ORM\OneToMany(mappedBy: 'articles', targetEntity: DetaileCommandes::class)]
    private Collection $detaileCommandes;

    public function __construct()
    {
        //$this->articlesImages = new ArrayCollection();
        $this->marques = new ArrayCollection();
        $this->detaileCommandes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->creat_at;
    }

    public function setCreatAt(\DateTimeImmutable $creat_at): static
    {
        $this->creat_at = $creat_at;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): static
    {
        $this->valid = $valid;

        return $this;
    }

    // /**
    //  * @return Collection<int, ArticlesImages>
    //  */
    // public function getArticlesImages(): Collection
    // {
    //     return $this->articlesImages;
    // }

    // public function addArticlesImage(ArticlesImages $articlesImage): static
    // {
    //     if (!$this->articlesImages->contains($articlesImage)) {
    //         $this->articlesImages->add($articlesImage);
    //         $articlesImage->setArticlesImg($this);
    //     }

    //     return $this;
    // }

    // public function removeArticlesImage(ArticlesImages $articlesImage): static
    // {
    //     if ($this->articlesImages->removeElement($articlesImage)) {
    //         // set the owning side to null (unless already changed)
    //         if ($articlesImage->getArticlesImg() === $this) {
    //             $articlesImage->setArticlesImg(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Marque>
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    public function addMarque(Marque $marque): static
    {
        if (!$this->marques->contains($marque)) {
            $this->marques->add($marque);
            $marque->setArticlesImages($this);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): static
    {
        if ($this->marques->removeElement($marque)) {
            // set the owning side to null (unless already changed)
            if ($marque->getArticlesImages() === $this) {
                $marque->setArticlesImages(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetaileCommandes>
     */
    public function getDetaileCommandes(): Collection
    {
        return $this->detaileCommandes;
    }

    public function addDetaileCommande(DetaileCommandes $detaileCommande): static
    {
        if (!$this->detaileCommandes->contains($detaileCommande)) {
            $this->detaileCommandes->add($detaileCommande);
            $detaileCommande->setArticles($this);
        }

        return $this;
    }

    public function removeDetaileCommande(DetaileCommandes $detaileCommande): static
    {
        if ($this->detaileCommandes->removeElement($detaileCommande)) {
            // set the owning side to null (unless already changed)
            if ($detaileCommande->getArticles() === $this) {
                $detaileCommande->setArticles(null);
            }
        }

        return $this;
    }
}
