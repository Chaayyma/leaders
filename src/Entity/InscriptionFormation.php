<?php

namespace App\Entity;

use App\Repository\InscriptionFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionFormationRepository::class)
 */
class InscriptionFormation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="inscriptionformation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=Condidat::class, inversedBy="inscriptionFormations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getCandidat(): ?Condidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Condidat $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }
}
