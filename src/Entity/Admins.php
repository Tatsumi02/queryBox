<?php

namespace App\Entity;

use App\Repository\AdminsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminsRepository::class)]
class Admins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $poste;

    #[ORM\Column(type: 'datetime')]
    private $date_debut_fonction;

    #[ORM\Column(type: 'string', length: 255)]
    private $competences;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cv;

    #[ORM\Column(type: 'text', nullable: true)]
    private $parcours;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'admins')]
    #[ORM\JoinColumn(nullable: false)]
    private $possesseur;

    #[ORM\OneToMany(mappedBy: 'admin', targetEntity: Requetes::class)]
    private $requetes;

    #[ORM\OneToMany(mappedBy: 'admin', targetEntity: Matieres::class, orphanRemoval: true)]
    private $matieres;

    public function __construct()
    {
        $this->requetes = new ArrayCollection();
        $this->matieres = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->poste;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getDateDebutFonction(): ?\DateTimeInterface
    {
        return $this->date_debut_fonction;
    }

    public function setDateDebutFonction(\DateTimeInterface $date_debut_fonction): self
    {
        $this->date_debut_fonction = $date_debut_fonction;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(string $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getParcours(): ?string
    {
        return $this->parcours;
    }

    public function setParcours(?string $parcours): self
    {
        $this->parcours = $parcours;

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
            $requete->setAdmin($this);
        }

        return $this;
    }

    public function removeRequete(Requetes $requete): self
    {
        if ($this->requetes->removeElement($requete)) {
            // set the owning side to null (unless already changed)
            if ($requete->getAdmin() === $this) {
                $requete->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matieres>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matieres $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setAdmin($this);
        }

        return $this;
    }

    public function removeMatiere(Matieres $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getAdmin() === $this) {
                $matiere->setAdmin(null);
            }
        }

        return $this;
    }
}
