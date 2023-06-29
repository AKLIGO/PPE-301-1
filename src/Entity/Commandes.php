<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\PseudoTypes\True_;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 231, unique: True)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creat_at = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Coupons $coupns = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: DetaileCommandes::class)]
    private Collection $detaileCommandes;

    public function __construct()
    {
        $this->detaileCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

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

    public function getCoupns(): ?Coupons
    {
        return $this->coupns;
    }

    public function setCoupns(?Coupons $coupns): static
    {
        $this->coupns = $coupns;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

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
            $detaileCommande->setCommandes($this);
        }

        return $this;
    }

    public function removeDetaileCommande(DetaileCommandes $detaileCommande): static
    {
        if ($this->detaileCommandes->removeElement($detaileCommande)) {
            // set the owning side to null (unless already changed)
            if ($detaileCommande->getCommandes() === $this) {
                $detaileCommande->setCommandes(null);
            }
        }

        return $this;
    }
}
