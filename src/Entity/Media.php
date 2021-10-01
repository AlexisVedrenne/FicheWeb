<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lien;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Contenue::class, inversedBy="lesmedias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contenue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContenue(): ?Contenue
    {
        return $this->contenue;
    }

    public function setContenue(?Contenue $contenue): self
    {
        $this->contenue = $contenue;

        return $this;
    }
}
