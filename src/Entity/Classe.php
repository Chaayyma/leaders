<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
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
    private $numcla;

    /**
     * @ORM\OneToOne(targetEntity=Formateur::class, mappedBy="classes", cascade={"persist", "remove"})
     */
    private $formateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcla(): ?int
    {
        return $this->numcla;
    }

    public function setNumcla(int $numcla): self
    {
        $this->numcla = $numcla;

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(Formateur $formateur): self
    {
        // set the owning side of the relation if necessary
        if ($formateur->getClasses() !== $this) {
            $formateur->setClasses($this);
        }

        $this->formateur = $formateur;

        return $this;
    }
}
