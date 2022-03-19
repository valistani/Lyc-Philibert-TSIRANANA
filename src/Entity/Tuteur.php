<?php

namespace App\Entity;

use App\Repository\TuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TuteurRepository::class)
 */
class Tuteur
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
    private $nom_t;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession_t;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_t;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse_t;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="tuteur")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomT(): ?string
    {
        return $this->nom_t;
    }

    public function setNomT(string $nom_t): self
    {
        $this->nom_t = $nom_t;

        return $this;
    }

    public function getProfessionT(): ?string
    {
        return $this->profession_t;
    }

    public function setProfessionT(string $profession_t): self
    {
        $this->profession_t = $profession_t;

        return $this;
    }

    public function getContactT(): ?string
    {
        return $this->contact_t;
    }

    public function setContactT(string $contact_t): self
    {
        $this->contact_t = $contact_t;

        return $this;
    }

    public function getAddresseT(): ?string
    {
        return $this->addresse_t;
    }

    public function setAddresseT(string $addresse_t): self
    {
        $this->addresse_t = $addresse_t;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setTuteur($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getTuteur() === $this) {
                $etudiant->setTuteur(null);
            }
        }

        return $this;
    }
}
