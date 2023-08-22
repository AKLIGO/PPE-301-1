<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeInterface $date_creat;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;



    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: CouponsCommandes::class, cascade: ['persist'])]
    private Collection $couponsCommandes;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: DetailsCommandes::class, cascade: ['persist'])]
    private Collection $detailsCommandes;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: CommandUsers::class, cascade: ['persist'])]
    private Collection $commandUsers;

    public function __construct()
    {
        $this->couponsCommandes = new ArrayCollection();
        $this->detailsCommandes = new ArrayCollection();
        $this->commandUsers = new ArrayCollection();
    }







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreat(): ?\DateTimeInterface
    {
        return $this->date_creat;
    }

    public function setDateCreat(\DateTimeInterface $date_creat): static
    {
        $this->date_creat = $date_creat;

        return $this;
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
            $couponsCommande->setCommandes($this);
        }

        return $this;
    }

    public function removeCouponsCommande(CouponsCommandes $couponsCommande): static
    {
        if ($this->couponsCommandes->removeElement($couponsCommande)) {
            // set the owning side to null (unless already changed)
            if ($couponsCommande->getCommandes() === $this) {
                $couponsCommande->setCommandes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailsCommandes>
     */
    public function getDetailsCommandes(): Collection
    {
        return $this->detailsCommandes;
    }

    public function addDetailsCommande(DetailsCommandes $detailsCommande): static
    {
        if (!$this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes->add($detailsCommande);
            $detailsCommande->setCommandes($this);
        }

        return $this;
    }

    public function removeDetailsCommande(DetailsCommandes $detailsCommande): static
    {
        if ($this->detailsCommandes->removeElement($detailsCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailsCommande->getCommandes() === $this) {
                $detailsCommande->setCommandes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandUsers>
     */
    public function getCommandUsers(): Collection
    {
        return $this->commandUsers;
    }

    public function addCommandUser(CommandUsers $commandUser): static
    {
        if (!$this->commandUsers->contains($commandUser)) {
            $this->commandUsers->add($commandUser);
            $commandUser->setCommandes($this);
        }

        return $this;
    }

    public function removeCommandUser(CommandUsers $commandUser): static
    {
        if ($this->commandUsers->removeElement($commandUser)) {
            // set the owning side to null (unless already changed)
            if ($commandUser->getCommandes() === $this) {
                $commandUser->setCommandes(null);
            }
        }

        return $this;
    }
}
