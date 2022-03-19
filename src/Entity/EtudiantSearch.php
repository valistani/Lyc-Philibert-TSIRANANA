<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class EtudiantSearch
{
    /**
     * @var string|null
     */
    private $nomS;
    /**
     * @var string|null
     */
    private $prenomS;
    /**
     * @var string|null
     */
    private $sexeS;
    /**
     * @var string|null
     */
    private $nationaliteS;
    /*
    /**
     * @var string|null
     */
   //private $parain;


   /* public  function __construct(){
        $this->parain = new ArrayCollection();
    }*/
    /**
     * @return string|null
     */
    public function getNomS(): ?string
    {
        return $this->nomS;
    }

    /**
     * @param string|null $nomS
     */
    public function setNomS(?string $nomS): void
    {
        $this->nomS = $nomS;
    }

    /**
     * @return string|null
     */
    public function getPrenomS(): ?string
    {
        return $this->prenomS;
    }

    /**
     * @param string|null $prenomS
     */
    public function setPrenomS(?string $prenomS): void
    {
        $this->prenomS = $prenomS;
    }

    /**
     * @return string|null
     */
    public function getSexeS(): ?string
    {
        return $this->sexeS;
    }

    /**
     * @param string|null $sexeS
     */
    public function setSexeS(?string $sexeS): void
    {
        $this->sexeS = $sexeS;
    }

    /**
     * @return string|null
     */
    public function getNationaliteS(): ?string
    {
        return $this->nationaliteS;
    }

    /**
     * @param string|null $nationaliteS
     */
    public function setNationaliteS(?string $nationaliteS): void
    {
        $this->nationaliteS = $nationaliteS;
    }
    /*
    /**
     * @return string|null
     */
    /*public function getParain(): ?string
    {
        return $this->parain;
    }

    /**
     * @param string|null $parain
     */
   /*public function setParain(?string $parain): void
    {
        $this->parain = $parain;
    }*/

}