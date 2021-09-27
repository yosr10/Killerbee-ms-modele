<?php

namespace App\Entity;

use App\Repository\ProcedeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProcedeRepository::class)
 */
class Procede
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etapes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_validation;

    /**
     * @ORM\OneToOne(targetEntity=Modele::class, mappedBy="procede", cascade={"persist", "remove"})
     */
    private $procede_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEtapes(): ?string
    {
        return $this->etapes;
    }

    public function setEtapes(string $etapes): self
    {
        $this->etapes = $etapes;

        return $this;
    }

    public function getDescriptionValidation(): ?string
    {
        return $this->description_validation;
    }

    public function setDescriptionValidation(string $description_validation): self
    {
        $this->description_validation = $description_validation;

        return $this;
    }

    public function getProcedeId(): ?Modele
    {
        return $this->procede_id;
    }

    public function setProcedeId(Modele $procede_id): self
    {
        // set the owning side of the relation if necessary
        if ($procede_id->getProcede() !== $this) {
            $procede_id->setProcede($this);
        }

        $this->procede_id = $procede_id;

        return $this;
    }
}
