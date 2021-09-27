<?php

namespace App\Entity;

use App\Repository\IngredientsComposeModeleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsComposeModeleRepository::class)
 */
class IngredientsComposeModele
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
    private $grammage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrammage(): ?int
    {
        return $this->grammage;
    }

    public function setGrammage(int $grammage): self
    {
        $this->grammage = $grammage;

        return $this;
    }
}
