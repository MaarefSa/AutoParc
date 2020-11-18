<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ChauffeurRepository")
 */
class Chauffeur
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
    public $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $prenom;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    public $numPermis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="chauffeur")
     */
    public $Affectation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $dateFunction;

    /**
     * @ORM\Column(type="integer")
     */
    public $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $adresse;

    public function __construct()
    {
        $this->Affectation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumPermis(): ?int
    {
        return $this->numPermis;
    }

    public function setNumPermis(int $numPermis): self
    {
        $this->numPermis = $numPermis;

        return $this;
    }

    /**
     * @return Collection|Affectation[]
     */
    public function getAffectation(): Collection
    {
        return $this->Affectation;
    }

    public function addAffectation(Affectation $affectation): self
    {
        if (!$this->Affectation->contains($affectation)) {
            $this->Affectation[] = $affectation;
            $affectation->setChauffeur($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->Affectation->contains($affectation)) {
            $this->Affectation->removeElement($affectation);
            // set the owning side to null (unless already changed)
            if ($affectation->getChauffeur() === $this) {
                $affectation->setChauffeur(null);
            }
        }

        return $this;
    }

    public function getDateFunction(): ?string
    {
        return $this->dateFunction;
    }

    public function setDateFunction(string $dateFunction): self
    {
        $this->dateFunction = $dateFunction;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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
