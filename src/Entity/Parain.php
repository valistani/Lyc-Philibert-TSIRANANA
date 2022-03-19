<?php

namespace App\Entity;

use App\Repository\ParainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParainRepository::class)
 */
class Parain
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
    private $nom_p;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession_p;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_p;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_m;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession_m;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact_m;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse_pa;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="parain")
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

    public function getNomP(): ?string
    {
        return $this->nom_p;
    }

    public function setNomP(string $nom_p): self
    {
        $this->nom_p = $nom_p;

        return $this;
    }

    public function getProfessionP(): ?string
    {
        return $this->profession_p;
    }

    public function setProfessionP(string $profession_p): self
    {
        $this->profession_p = $profession_p;

        return $this;
    }

    public function getContactP(): ?string
    {
        return $this->contact_p;
    }

    public function setContactP(string $contact_p): self
    {
        $this->contact_p = $contact_p;

        return $this;
    }

    public function getNomM(): ?string
    {
        return $this->nom_m;
    }

    public function setNomM(string $nom_m): self
    {
        $this->nom_m = $nom_m;

        return $this;
    }

    public function getProfessionM(): ?string
    {
        return $this->profession_m;
    }

    public function setProfessionM(string $profession_m): self
    {
        $this->profession_m = $profession_m;

        return $this;
    }

    public function getContactM(): ?string
    {
        return $this->contact_m;
    }

    public function setContactM(string $contact_m): self
    {
        $this->contact_m = $contact_m;

        return $this;
    }

    public function getAddressePa(): ?string
    {
        return $this->addresse_pa;
    }

    public function setAddressePa(string $addresse_pa): self
    {
        $this->addresse_pa = $addresse_pa;

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
            $etudiant->setParain($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getParain() === $this) {
                $etudiant->setParain(null);
            }
        }

        return $this;
    }
}
