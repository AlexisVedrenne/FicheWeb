<?php

namespace App\Entity;

use App\Repository\FicheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheRepository::class)
 */
class Fiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=1, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="lesFiches")
     */
    private $lesCategories;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="laFiche")
     */
    private $lesCommentaires;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lesFiches")
     */
    private $user;

    public function __construct()
    {
        $this->lesCategories = new ArrayCollection();
        $this->lesCommentaires = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getLesCategories(): Collection
    {
        return $this->lesCategories;
    }

    public function addLesCategory(Categorie $lesCategory): self
    {
        if (!$this->lesCategories->contains($lesCategory)) {
            $this->lesCategories[] = $lesCategory;
            $lesCategory->addLesFich($this);
        }

        return $this;
    }

    public function removeLesCategory(Categorie $lesCategory): self
    {
        if ($this->lesCategories->removeElement($lesCategory)) {
            $lesCategory->removeLesFich($this);
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
            $lesCommentaire->setLaFiche($this);
        }

        return $this;
    }

    public function removeLesCommentaire(Commentaire $lesCommentaire): self
    {
        if ($this->lesCommentaires->removeElement($lesCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($lesCommentaire->getLaFiche() === $this) {
                $lesCommentaire->setLaFiche(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
