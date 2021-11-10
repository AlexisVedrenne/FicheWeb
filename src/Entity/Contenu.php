<?php

namespace App\Entity;

use App\Repository\ContenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenuRepository::class)
 */
class Contenu
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
    private $rubrique;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Fiche::class, inversedBy="contenus",cascade={"persist"})
     */
    private $Fiche;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="contenu", orphanRemoval=true,cascade={"persist"})
     */
    private $lesMedias;

    public function __construct()
    {
        $this->lesMedias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRubrique(): ?string
    {
        return $this->rubrique;
    }

    public function setRubrique(string $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFiche(): ?Fiche
    {
        return $this->Fiche;
    }

    public function setFiche(?Fiche $Fiche): self
    {
        $this->Fiche = $Fiche;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getLesMedias(): Collection
    {
        return $this->lesMedias;
    }

    public function addLesMedia(Media $lesMedia): self
    {
        if (!$this->lesMedias->contains($lesMedia)) {
            $this->lesMedias[] = $lesMedia;
            $lesMedia->setContenu($this);
        }

        return $this;
    }

    public function removeLesMedia(Media $lesMedia): self
    {
        if ($this->lesMedias->removeElement($lesMedia)) {
            // set the owning side to null (unless already changed)
            if ($lesMedia->getContenu() === $this) {
                $lesMedia->setContenu(null);
            }
        }

        return $this;
    }
}
