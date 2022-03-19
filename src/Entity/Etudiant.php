<?php

namespace App\Entity;
use App\Repository\EtudiantRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 * @UniqueEntity("prenom_e")
 * @Vich\Uploadable()
 */
class Etudiant
{
    const SEXE = [
        'Garçon' => 'Garçon',
        'Fille' => 'Fille'
    ];

    const NATIONALITE = [
        'Malagasy' => 'Malagasy',
        'Etranger' => 'Etranger'
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\Length(min=5,max=255)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_e;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse_e;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_naissance_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone_e;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_e;

    /**
     * @var string|null
     * @ORM\Column(type="string",length=255)
     */
    private $filename;
    /**
     * @var File|null
     * @Assert\Image(mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="etudiant_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Parain::class, inversedBy="etudiants")
     */
    private $parain;

    /**
     * @ORM\ManyToOne(targetEntity=Tuteur::class, inversedBy="etudiants")
     */
    private $tuteur;

    /**
     * @ORM\ManyToOne(targetEntity=Scolaire::class, inversedBy="etudiants")
     */
    private $scolaire;

    /**
     * @ORM\ManyToMany(targetEntity=Matiere::class, mappedBy="etudiants")
     */
    private $matieres;

    public function __construct(){
        $this->created_at = new \DateTime();
        $this->date_naissance_e = new \DateTime();
        $this->matieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomE(): ?string
    {
        return $this->nom_e;
    }
    public function setNomE(string $nom_e): self
    {
        $this->nom_e = $nom_e;

        return $this;
    }
    public function getSlug():string
    {
        return $slug = (new Slugify())->slugify($this->prenom_e);
    }
    public function getPrenomE(): ?string
    {
        return $this->prenom_e;
    }

    public function setPrenomE(string $prenom_e): self
    {
        $this->prenom_e = $prenom_e;

        return $this;
    }

    public function getDateNaissanceE(): ?\DateTimeInterface
    {
         $dts = $this->date_naissance_e;
         return $dts;
    }

    public function formatDtStr(): string
    {
        //return date_format($this->date_naissance_e,'Y-m-d');
        //return date_format($this->date_naissance_e,'d-m-Y');
        //return date_format($this->date_naissance_e,'d-F-Y');
        return date_format($this->date_naissance_e,'d M Y');
    }

    public function setDateNaissanceE(\DateTimeInterface $date_naissance_e): self
    {
        $this->date_naissance_e = $date_naissance_e;

        return $this;
    }

    public function getSexeE(): ?string
    {
        return $this->sexe_e;
    }

    public function setSexeE(string $sexe_e): self
    {
        $this->sexe_e = $sexe_e;

        return $this;
    }

    public  function getSexeType(): string
    {
        return self::SEXE[$this->sexe_e];
    }

    public function getAddresseE(): ?string
    {
        return $this->addresse_e;
    }

    public function setAddresseE(string $addresse_e): self
    {
        $this->addresse_e = $addresse_e;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLieuNaissanceE(): ?string
    {
        return $this->lieu_naissance_e;
    }

    public function setLieuNaissanceE(string $lieu_naissance_e): self
    {
        $this->lieu_naissance_e = $lieu_naissance_e;

        return $this;
    }

    public function getNationaliteE(): ?string
    {
        return $this->nationalite_e;
    }

    public function setNationaliteE(string $nationalite_e): self
    {
        $this->nationalite_e = $nationalite_e;

        return $this;
    }

    public function getNationaliteType():string
    {
        return self::NATIONALITE[$this->nationalite_e];
    }

    public function getPhoneE(): ?string
    {
        return $this->phone_e;
    }

    public function setPhoneE(string $phone_e): self
    {
        $this->phone_e = $phone_e;

        return $this;
    }

    public function getEmailE(): ?string
    {
        return $this->email_e;
    }

    public function setEmailE(string $email_e): self
    {
        $this->email_e = $email_e;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return Etudiant
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }


    public function getParain(): ?Parain
    {
        return $this->parain;
    }

    public function setParain(?Parain $parain): self
    {
        $this->parain = $parain;

        return $this;
    }
    public function getTuteur(): ?Tuteur
    {
        return $this->tuteur;
    }

    public function setTuteur(?Parain $tuteur): self
    {
        $this->tuteur = $tuteur;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     */
    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Etudiant
     */
    public function setImageFile(?File $imageFile): Etudiant
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getScolaire(): ?Scolaire
    {
        return $this->scolaire;
    }

    public function setScolaire(?Scolaire $scolaire): self
    {
        $this->scolaire = $scolaire;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->addEtudiant($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            $matiere->removeEtudiant($this);
        }

        return $this;
    }

}
