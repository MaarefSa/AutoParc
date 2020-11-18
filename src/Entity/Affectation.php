<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffectationRepository")
 */
class Affectation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $debutAffect;

    /**
     * @ORM\Column(type="string")
     */
    public $finAffectPrevue;

    /**
     * @ORM\Column(type="string")
     */
    public $finAffectReelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $direction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="affectation")
     * @ORM\JoinColumn(nullable=false)
     */
    public $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chauffeur", inversedBy="Affectation")
     * @ORM\JoinColumn(nullable=false)
     */
    public $chauffeur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Consommation", mappedBy="affectation", cascade={"persist", "remove"})
     */
    private $consommation;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    public $codeMission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutAffect(): ?string
    {
        return $this->debutAffect;
    }

    public function setDebutAffect(string $debutAffect): self
    {
        $this->debutAffect = $debutAffect;

        return $this;
    }

    public function getFinAffectPrevue(): ?string
    {
        return $this->finAffectPrevue;
    }

    public function setFinAffectPrevue(string $finAffectPrevue): self
    {
        $this->finAffectPrevue = $finAffectPrevue;

        return $this;
    }

    public function getFinAffectReelle(): ?string
    {
        return $this->finAffectReelle;
    }

    public function setFinAffectReelle(string $finAffectReelle): self
    {
        $this->finAffectReelle = $finAffectReelle;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getChauffeur(): ?Chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?Chauffeur $chauffeur): self
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    public function getConsommation(): ?Consommation
    {
        return $this->consommation;
    }

    public function setConsommation(Consommation $consommation): self
    {
        $this->consommation = $consommation;

        // set the owning side of the relation if necessary
        if ($this !== $consommation->getAffectation()) {
            $consommation->setAffectation($this);
        }

        return $this;
    }

    public function getCodeMission(): ?string
    {
        return $this->codeMission;
    }

    public function setCodeMission(string $codeMission): self
    {
        $this->codeMission = $codeMission;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
