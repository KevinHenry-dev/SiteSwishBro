<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $id_terrain = null;

    #[ORM\Column(length: 255)]
    private ?string $id_match = null;

    #[ORM\Column(length: 255)]
    private ?string $id_user = null;

    #[ORM\Column(length: 255)]
    private ?string $id_team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTerrain(): ?string
    {
        return $this->id_terrain;
    }

    public function setIdTerrain(string $id_terrain): static
    {
        $this->id_terrain = $id_terrain;

        return $this;
    }

    public function getIdMatch(): ?string
    {
        return $this->id_match;
    }

    public function setIdMatch(string $id_match): static
    {
        $this->id_match = $id_match;

        return $this;
    }

    public function getIdUser(): ?string
    {
        return $this->id_user;
    }

    public function setIdUser(string $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdTeam(): ?string
    {
        return $this->id_team;
    }

    public function setIdTeam(string $id_team): static
    {
        $this->id_team = $id_team;

        return $this;
    }
}
