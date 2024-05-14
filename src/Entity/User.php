<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un compte est déjà lier à cet email')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /* #[Assert\Email] */
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;
    

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_de_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $Tel = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ban = false;

    #[ORM\OneToMany(targetEntity: Calendar::class, mappedBy: 'User')]
    private Collection $calendars;

    #[ORM\OneToMany(targetEntity: Reservations::class, mappedBy: 'User')]
    private Collection $reservations;

    #[ORM\ManyToMany(targetEntity: Terrain::class, inversedBy: 'users')]
    private Collection $Terrain;

    #[ORM\ManyToMany(targetEntity: MatchBasket::class, inversedBy: 'users')]
    private Collection $MatchBasket;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'users')]
    private Collection $Team;



    

    public function __construct()
    {
        $this->calendars = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->Terrain = new ArrayCollection();
        $this->MatchBasket = new ArrayCollection();
        $this->Team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(?string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->Date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $Date_de_naissance): static
    {
        $this->Date_de_naissance = $Date_de_naissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function isBan(): ?bool
    {
        return $this->ban;
    }

    public function setBan(?bool $ban): static
    {
        $this->ban = $ban;

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): static
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars->add($calendar);
            $calendar->setUser($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): static
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getUser() === $this) {
                $calendar->setUser(null);
            }
        }

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
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

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

    /**
     * @return Collection<int, MatchBasket>
     */
    public function getMatchBasket(): Collection
    {
        return $this->MatchBasket;
    }

    public function addMatchBasket(MatchBasket $matchBasket): static
    {
        if (!$this->MatchBasket->contains($matchBasket)) {
            $this->MatchBasket->add($matchBasket);
        }

        return $this;
    }

    public function removeMatchBasket(MatchBasket $matchBasket): static
    {
        $this->MatchBasket->removeElement($matchBasket);

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeam(): Collection
    {
        return $this->Team;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->Team->contains($team)) {
            $this->Team->add($team);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        $this->Team->removeElement($team);

        return $this;
    }


 
}
