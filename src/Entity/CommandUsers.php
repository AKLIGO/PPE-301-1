<?php

namespace App\Entity;

use App\Repository\CommandUsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandUsersRepository::class)]
class CommandUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandUsers')]
    private ?Commandes $commandes = null;

    #[ORM\ManyToOne(inversedBy: 'commandUsers')]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
