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
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="laCategorie", orphanRemoval=true)
     */
    private $fiches;

    /**
     * @ORM\OneToMany(targetEntity=DemandeFiche::class, mappedBy="categorie")
     */
    private $demandeFiches;


    public function __construct()
    {
        $this->lesFiches = new ArrayCollection();
        $this->fiches = new ArrayCollection();
        $this->demandeFiches = new ArrayCollection();
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

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFiche(Fiche $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setLaCategorie($this);
        }

        return $this;
    }

    public function removeFiche(Fiche $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getLaCategorie() === $this) {
                $fich->setLaCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DemandeFiche[]
     */
    public function getDemandeFiches(): Collection
    {
        return $this->demandeFiches;
    }

    public function addDemandeFich(DemandeFiche $demandeFich): self
    {
        if (!$this->demandeFiches->contains($demandeFich)) {
            $this->demandeFiches[] = $demandeFich;
            $demandeFich->setCategorie($this);
        }

        return $this;
    }

    public function removeDemandeFich(DemandeFiche $demandeFich): self
    {
        if ($this->demandeFiches->removeElement($demandeFich)) {
            // set the owning side to null (unless already changed)
            if ($demandeFich->getCategorie() === $this) {
                $demandeFich->setCategorie(null);
            }
        }

        return $this;
    }

   
  
}
