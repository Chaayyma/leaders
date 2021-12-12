<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebutse;

    /**
     * @ORM\Column(type="date")
     */
    private $datefinse;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, mappedBy="session")
     */
    private $formations;


    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebutse(): ?\DateTimeInterface
    {
        return $this->datedebutse;
    }

    public function setDatedebutse(\DateTimeInterface $datedebutse): self
    {
        $this->datedebutse = $datedebutse;

        return $this;
    }

    public function getDatefinse(): ?\DateTimeInterface
    {
        return $this->datefinse;
    }

    public function setDatefinse(\DateTimeInterface $datefinse): self
    {
        $this->datefinse = $datefinse;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addSession($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeSession($this);
        }

        return $this;
    }

}
