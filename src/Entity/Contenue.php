<?php

namespace App\Entity;

use App\Repository\ContenueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenueRepository::class)
 */
class Contenue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="contenue", orphanRemoval=true)
     */
    private $lesmedias;

    public function __construct()
    {
        $this->lesmedias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Media[]
     */
    public function getLesmedias(): Collection
    {
        return $this->lesmedias;
    }

    public function addLesmedia(Media $lesmedia): self
    {
        if (!$this->lesmedias->contains($lesmedia)) {
            $this->lesmedias[] = $lesmedia;
            $lesmedia->setContenue($this);
        }

        return $this;
    }

    public function removeLesmedia(Media $lesmedia): self
    {
        if ($this->lesmedias->removeElement($lesmedia)) {
            // set the owning side to null (unless already changed)
            if ($lesmedia->getContenue() === $this) {
                $lesmedia->setContenue(null);
            }
        }

        return $this;
    }
}
