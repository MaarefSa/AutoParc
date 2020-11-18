<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsommationRepository")
 */
class Consommation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    public $reference;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Affectation", inversedBy="consommation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $affectation;

    /**
     * @ORM\Column(type="float")
     */
    public $carburant;

    /**
     * @ORM\Column(type="float")
     */
    public $huile;

    /**
     * @ORM\Column(type="float")
     */
    public $fixe;

    /**
     * @ORM\Column(type="float")
     */
    public $divers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getAffectation(): ?Affectation
    {
        return $this->affectation;
    }

    public function setAffectation(Affectation $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getCarburant(): ?float
    {
        return $this->carburant;
    }

    public function setCarburant(float $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getHuile(): ?float
    {
        return $this->huile;
    }

    public function setHuile(float $huile): self
    {
        $this->huile = $huile;

        return $this;
    }

    public function getFixe(): ?float
    {
        return $this->fixe;
    }

    public function setFixe(float $fixe): self
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getDivers(): ?float
    {
        return $this->divers;
    }

    public function setDivers(float $divers): self
    {
        $this->divers = $divers;

        return $this;
    }
}
