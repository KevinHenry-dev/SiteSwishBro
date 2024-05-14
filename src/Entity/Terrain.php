<?php

namespace App\Entity;

use App\Repository\TerrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TerrainRepository::class)]
class Terrain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_tdb = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse_tdb = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $Long_tdb = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $Latt_tdb = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle_ville = null;

    #[ORM\ManyToMany(targetEntity: Reservations::class, mappedBy: 'Terrain')]
    private Collection $reservations;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Terrain')]
    private Collection $users;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTdb(): ?string
    {
        return $this->Nom_tdb;
    }

    public function setNomTdb(string $Nom_tdb): static
    {
        $this->Nom_tdb = $Nom_tdb;

        return $this;
    }

    public function getAdresseTdb(): ?string
    {
        return $this->Adresse_tdb;
    }

    public function setAdresseTdb(string $Adresse_tdb): static
    {
        $this->Adresse_tdb = $Adresse_tdb;

        return $this;
    }

    public function getLongTdb(): ?string
    {
        return $this->Long_tdb;
    }

    public function setLongTdb(string $Long_tdb): static
    {
        $this->Long_tdb = $Long_tdb;

        return $this;
    }

    public function getLattTdb(): ?string
    {
        return $this->Latt_tdb;
    }

    public function setLattTdb(string $Latt_tdb): static
    {
        $this->Latt_tdb = $Latt_tdb;

        return $this;
    }

    public function getLibelleVille(): ?string
    {
        return $this->Libelle_ville;
    }

    public function setLibelleVille(string $Libelle_ville): static
    {
        $this->Libelle_ville = $Libelle_ville;

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addTerrain($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeTerrain($this);
        }

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
            $user->addTerrain($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeTerrain($this);
        }

        return $this;
    }
}
