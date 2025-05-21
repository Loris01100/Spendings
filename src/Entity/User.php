<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'float')]
    private float $argent = 0.0;

    #[ORM\OneToMany(targetEntity: Achat::class, mappedBy: 'id_utilisateur')]
    private Collection $achats;

    #[ORM\OneToMany(targetEntity: Abonnement::class, mappedBy: 'id_utilisateur')]
    private Collection $abonnements;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
        $this->abonnements = new ArrayCollection();
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

    public function getArgent(): float
    {
        return $this->argent;
    }

    public function setArgent(float $argent): static
    {
        $this->argent = $argent;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
         return ['ROLE_USER'];

    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // $this->plainPassword = null;
    }

    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): static
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setIdUtilisateur($this);
        }
        return $this;
    }

    public function removeAchat(Achat $achat): static
    {
        if ($this->achats->removeElement($achat)) {
            if ($achat->getIdUtilisateur() === $this) {
                $achat->setIdUtilisateur(null);
            }
        }
        return $this;
    }

    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): static
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements->add($abonnement);
            $abonnement->setIdUtilisateur($this);
        }
        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): static
    {
        if ($this->abonnements->removeElement($abonnement)) {
            if ($abonnement->getIdUtilisateur() === $this) {
                $abonnement->setIdUtilisateur(null);
            }
        }
        return $this;
    }
}
