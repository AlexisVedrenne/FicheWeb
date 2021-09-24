<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Fiche::class, inversedBy="lesCategories")
     */
    private $lesFiches;

    public function __construct()
    {
        $this->lesFiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
        }

        return $this;
    }

    public function removeLesFich(Fiche $lesFich): self
    {
        $this->lesFiches->removeElement($lesFich);

        return $this;
    }
}
