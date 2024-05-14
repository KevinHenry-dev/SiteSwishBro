<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Calendar $Calendar = null;

    #[ORM\ManyToMany(targetEntity: Terrain::class, inversedBy: 'reservations')]
    private Collection $Terrain;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MatchBasket $MatchBasket = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $User = null;

    public function __construct()
    {
        $this->Terrain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->Calendar;
    }

    public function setCalendar(?Calendar $Calendar): static
    {
        $this->Calendar = $Calendar;

        return $this;
    }

    /**
     * @return Collection<int, Terrain>
     */
    public function getTerrain(): Collection
    {
        return $this->Terrain;
    }

    public function addTerrain(Terrain $terrain): static
    {
        if (!$this->Terrain->contains($terrain)) {
            $this->Terrain->add($terrain);
        }

        return $this;
    }

    public function removeTerrain(Terrain $terrain): static
    {
        $this->Terrain->removeElement($terrain);

        return $this;
    }

    public function getMatchBasket(): ?MatchBasket
    {
        return $this->MatchBasket;
    }

    public function setMatchBasket(?MatchBasket $MatchBasket): static
    {
        $this->MatchBasket = $MatchBasket;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
