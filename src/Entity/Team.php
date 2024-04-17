<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $id_user = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_team = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomTeam(): ?string
    {
        return $this->Nom_team;
    }

    public function setNomTeam(string $Nom_team): static
    {
        $this->Nom_team = $Nom_team;

        return $this;
    }
}
