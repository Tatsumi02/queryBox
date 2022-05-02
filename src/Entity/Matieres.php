<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $specialite;

    #[ORM\Column(type: 'string', length: 255)]
    private $niveau;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statut;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Requetes::class, orphanRemoval: true)]
    private $requetes;

    #[ORM\ManyToOne(targetEntity: Admins::class, inversedBy: 'matieres')]
    #[ORM\JoinColumn(nullable: false)]
    private $admin;

    public function __construct()
    {
        $this->requetes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Requetes>
     */
    public function getRequetes(): Collection
    {
        return $this->requetes;
    }

    public function addRequete(Requetes $requete): self
    {
        if (!$this->requetes->contains($requete)) {
            $this->requetes[] = $requete;
            $requete->setMatiere($this);
        }

        return $this;
    }

    public function removeRequete(Requetes $requete): self
    {
        if ($this->requetes->removeElement($requete)) {
            // set the owning side to null (unless already changed)
            if ($requete->getMatiere() === $this) {
                $requete->setMatiere(null);
            }
        }

        return $this;
    }

    public function getAdmin(): ?Admins
    {
        return $this->admin;
    }

    public function setAdmin(?Admins $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
