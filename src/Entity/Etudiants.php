<?php

namespace App\Entity;

use App\Repository\EtudiantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantsRepository::class)]
class Etudiants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $filiere;

    #[ORM\Column(type: 'string', length: 255)]
    private $niveau;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $diplome;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dernier_etablissement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $possesseur;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Requetes::class, orphanRemoval: true)]
    private $requetes;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Revendications::class, orphanRemoval: true)]
    private $revendications;

    public function __construct()
    {
        $this->requetes = new ArrayCollection();
        $this->revendications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

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

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getDernierEtablissement(): ?string
    {
        return $this->dernier_etablissement;
    }

    public function setDernierEtablissement(?string $dernier_etablissement): self
    {
        $this->dernier_etablissement = $dernier_etablissement;

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

    public function getPossesseur(): ?User
    {
        return $this->possesseur;
    }

    public function setPossesseur(?User $possesseur): self
    {
        $this->possesseur = $possesseur;

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
            $requete->setEtudiant($this);
        }

        return $this;
    }

    public function removeRequete(Requetes $requete): self
    {
        if ($this->requetes->removeElement($requete)) {
            // set the owning side to null (unless already changed)
            if ($requete->getEtudiant() === $this) {
                $requete->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Revendications>
     */
    public function getRevendications(): Collection
    {
        return $this->revendications;
    }

    public function addRevendication(Revendications $revendication): self
    {
        if (!$this->revendications->contains($revendication)) {
            $this->revendications[] = $revendication;
            $revendication->setEtudiant($this);
        }

        return $this;
    }

    public function removeRevendication(Revendications $revendication): self
    {
        if ($this->revendications->removeElement($revendication)) {
            // set the owning side to null (unless already changed)
            if ($revendication->getEtudiant() === $this) {
                $revendication->setEtudiant(null);
            }
        }

        return $this;
    }
}
