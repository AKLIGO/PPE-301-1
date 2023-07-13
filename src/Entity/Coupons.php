<?php

namespace App\Entity;

use App\Repository\CouponsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
class Coupons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $valeur = null;

    #[ORM\Column]
    private ?bool $statut = null;

    #[ORM\Column]
    private ?int $max_usage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_create = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_expiration = null;

    #[ORM\ManyToOne(inversedBy: 'coupons')]
    private ?CouponsTypes $couponsType = null;

    #[ORM\OneToMany(mappedBy: 'coupons', targetEntity: CouponsCommandes::class)]
    private Collection $couponsCommandes;

    public function __construct()
    {
        $this->couponsCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getMaxUsage(): ?int
    {
        return $this->max_usage;
    }

    public function setMaxUsage(int $max_usage): static
    {
        $this->max_usage = $max_usage;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): static
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(\DateTimeInterface $date_expiration): static
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }

    public function getCouponsType(): ?CouponsTypes
    {
        return $this->couponsType;
    }

    public function setCouponsType(?CouponsTypes $couponsType): static
    {
        $this->couponsType = $couponsType;

        return $this;
    }

    /**
     * @return Collection<int, CouponsCommandes>
     */
    public function getCouponsCommandes(): Collection
    {
        return $this->couponsCommandes;
    }

    public function addCouponsCommande(CouponsCommandes $couponsCommande): static
    {
        if (!$this->couponsCommandes->contains($couponsCommande)) {
            $this->couponsCommandes->add($couponsCommande);
            $couponsCommande->setCoupons($this);
        }

        return $this;
    }

    public function removeCouponsCommande(CouponsCommandes $couponsCommande): static
    {
        if ($this->couponsCommandes->removeElement($couponsCommande)) {
            // set the owning side to null (unless already changed)
            if ($couponsCommande->getCoupons() === $this) {
                $couponsCommande->setCoupons(null);
            }
        }

        return $this;
    }
}
