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





    #[ORM\ManyToMany(targetEntity: Terrain::class, inversedBy: 'reservations')]
    private Collection $Terrain;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $id_user = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Calendar $id_calendar = null;



    public function __construct()
    {
        $this->Terrain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdCalendar(): ?Calendar
    {
        return $this->id_calendar;
    }

    public function setIdCalendar(?Calendar $id_calendar): static
    {
        $this->id_calendar = $id_calendar;

        return $this;
    }


}
