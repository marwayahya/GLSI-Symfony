<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="client", orphanRemoval=true)
     */
    private $locationVoiture;

    public function __construct()
    {
        $this->locationVoiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocationVoiture(): Collection
    {
        return $this->locationVoiture;
    }

    public function addLocationVoiture(Location $locationVoiture): self
    {
        if (!$this->locationVoiture->contains($locationVoiture)) {
            $this->locationVoiture[] = $locationVoiture;
            $locationVoiture->setClient($this);
        }

        return $this;
    }

    public function removeLocationVoiture(Location $locationVoiture): self
    {
        if ($this->locationVoiture->removeElement($locationVoiture)) {
            // set the owning side to null (unless already changed)
            if ($locationVoiture->getClient() === $this) {
                $locationVoiture->setClient(null);
            }
        }

        return $this;
    }
}
