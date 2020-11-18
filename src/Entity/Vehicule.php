<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $immatricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $numchassis;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    public $cartegrise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="vehicule")
     */
    public $affectation;


    public function __construct()
    {
        $this->affectation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatricule(): ?string
    {
        return $this->immatricule;
    }

    public function setImmatricule(string $immatricule): self
    {
        $this->immatricule = $immatricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getNumchassis(): ?string
    {
        return $this->numchassis;
    }

    public function setNumchassis(string $numchassis): self
    {
        $this->numchassis = $numchassis;

        return $this;
    }

    public function getCartegrise(): ?int
    {
        return $this->cartegrise;
    }

    public function setCartegrise(int $cartegrise): self
    {
        $this->cartegrise = $cartegrise;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Affectation[]
     */
    public function getAffectation(): Collection
    {
        return $this->affectation;
    }

    public function addAffectation(Affectation $affectation): self
    {
        if (!$this->affectation->contains($affectation)) {
            $this->affectation[] = $affectation;
            $affectation->setVehiculeId($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->affectation->contains($affectation)) {
            $this->affectation->removeElement($affectation);
            // set the owning side to null (unless already changed)
            if ($affectation->getVehiculeId() === $this) {
                $affectation->setVehiculeId(null);
            }
        }

        return $this;
    }


}
