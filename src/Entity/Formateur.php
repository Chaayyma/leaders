<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 */
class Formateur extends User1
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
    private $niveau_etude;

    /**
     * @ORM\Column(type="float")
     */
    private $experience;

    /**
     * @ORM\ManyToMany(targetEntity=Condidat::class, mappedBy="formateur")
     */
    private $condidats;

    /**
     * @ORM\OneToOne(targetEntity=Classe::class, inversedBy="formateur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $classes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade;

    public function __construct()
    {
        $this->condidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveauEtuded(): ?string
    {
        return $this->niveau_etude;
    }

    public function setNiveauEtude(string $niveau_etude): self
    {
        $this->niveau_etude = $niveau_etude;

        return $this;
    }

    public function getExperience(): ?float
    {
        return $this->experience;
    }

    public function setExperience(float $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return Collection|Condidat[]
     */
    public function getCondidat(): Collection
    {
        return $this->condidats;
    }

    public function addCondidat(Condidat $condidat): self
    {
        if (!$this->condidats->contains($condidat)) {
            $this->condidats[] = $condidat;
            $condidat->addFormateur($this);
        }

        return $this;
    }

    public function removeCondidat(Condidat $condidat): self
    {
        if ($this->condidats->removeElement($condidat)) {
            $condidat->removeFormateur($this);
        }

        return $this;
    }

    public function getClasses(): ?Classe
    {
        return $this->classes;
    }

    public function setClasses(Classe $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }
}