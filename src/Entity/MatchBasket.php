<?php

namespace App\Entity;

use App\Repository\MatchBasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchBasketRepository::class)]
class MatchBasket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Genre_match = null;

    #[ORM\Column]
    private ?int $Nombres_joueur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_match = null;

    #[ORM\Column]
    private ?int $Duree_match = null;

    #[ORM\Column]
    private ?int $Points_match = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'MatchBasket')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenreMatch(): ?string
    {
        return $this->Genre_match;
    }

    public function setGenreMatch(string $Genre_match): static
    {
        $this->Genre_match = $Genre_match;

        return $this;
    }

    public function getNombresJoueur(): ?int
    {
        return $this->Nombres_joueur;
    }

    public function setNombresJoueur(int $Nombres_joueur): static
    {
        $this->Nombres_joueur = $Nombres_joueur;

        return $this;
    }

    public function getDateMatch(): ?\DateTimeInterface
    {
        return $this->Date_match;
    }

    public function setDateMatch(\DateTimeInterface $Date_match): static
    {
        $this->Date_match = $Date_match;

        return $this;
    }

    public function getDureeMatch(): ?int
    {
        return $this->Duree_match;
    }

    public function setDureeMatch(int $Duree_match): static
    {
        $this->Duree_match = $Duree_match;

        return $this;
    }

    public function getPointsMatch(): ?int
    {
        return $this->Points_match;
    }

    public function setPointsMatch(int $Points_match): static
    {
        $this->Points_match = $Points_match;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addMatchBasket($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeMatchBasket($this);
        }

        return $this;
    }
}
