<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statutConnexion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="user")
     */
    private $lesFiches;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="user")
     */
    private $lesCommentaires;

    public function __construct()
    {
        $this->lesFiches = new ArrayCollection();
        $this->lesCommentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getStatutConnexion(): ?bool
    {
        return $this->statutConnexion;
    }

    public function setStatutConnexion(bool $statutConnexion): self
    {
        $this->statutConnexion = $statutConnexion;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getLesFiches(): Collection
    {
        return $this->lesFiches;
    }

    public function addLesFich(Fiche $lesFich): self
    {
        if (!$this->lesFiches->contains($lesFich)) {
            $this->lesFiches[] = $lesFich;
            $lesFich->setUser($this);
        }

        return $this;
    }

    public function removeLesFich(Fiche $lesFich): self
    {
        if ($this->lesFiches->removeElement($lesFich)) {
            // set the owning side to null (unless already changed)
            if ($lesFich->getUser() === $this) {
                $lesFich->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getLesCommentaires(): Collection
    {
        return $this->lesCommentaires;
    }

    public function addLesCommentaire(Commentaire $lesCommentaire): self
    {
        if (!$this->lesCommentaires->contains($lesCommentaire)) {
            $this->lesCommentaires[] = $lesCommentaire;
            $lesCommentaire->setUser($this);
        }

        return $this;
    }

    public function removeLesCommentaire(Commentaire $lesCommentaire): self
    {
        if ($this->lesCommentaires->removeElement($lesCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($lesCommentaire->getUser() === $this) {
                $lesCommentaire->setUser(null);
            }
        }

        return $this;
    }
}
