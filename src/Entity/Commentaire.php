<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $texte;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=1, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Fiche::class, inversedBy="lesCommentaires")
     */
    private $laFiche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

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

    public function getLaFiche(): ?Fiche
    {
        return $this->laFiche;
    }

    public function setLaFiche(?Fiche $laFiche): self
    {
        $this->laFiche = $laFiche;

        return $this;
    }
}
