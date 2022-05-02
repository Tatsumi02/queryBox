<?php

namespace App\Entity;

use App\Repository\RequetesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequetesRepository::class)]
class Requetes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $recu;

    #[ORM\Column(type: 'string', length: 255)]
    private $quitus;

    #[ORM\Column(type: 'string', length: 255)]
    private $objet;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $etat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: Etudiants::class, inversedBy: 'requetes')]
    #[ORM\JoinColumn(nullable: false)]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: Admins::class, inversedBy: 'requetes')]
    private $admin;

    #[ORM\ManyToOne(targetEntity: Matieres::class, inversedBy: 'requetes')]
    #[ORM\JoinColumn(nullable: false)]
    private $matiere;

    #[ORM\OneToMany(mappedBy: 'requete', targetEntity: Revendications::class, orphanRemoval: true)]
    private $revendications;

    #[ORM\Column(type: 'datetime')]
    private $date_depot;

    #[ORM\Column(type: 'datetime',nullable: true)]
    private $date_traite;

    public function __construct()
    {
        $this->revendications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecu(): ?string
    {
        return $this->recu;
    }

    public function setRecu(string $recu): self
    {
        $this->recu = $recu;

        return $this;
    }

    public function getQuitus(): ?string
    {
        return $this->quitus;
    }

    public function setQuitus(string $quitus): self
    {
        $this->quitus = $quitus;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

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

    public function getEtudiant(): ?Etudiants
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiants $etudiant): self
    {
        $this->etudiant = $etudiant;

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

    public function getMatiere(): ?Matieres
    {
        return $this->matiere;
    }

    public function setMatiere(?Matieres $matiere): self
    {
        $this->matiere = $matiere;

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
            $revendication->setRequete($this);
        }

        return $this;
    }

    public function removeRevendication(Revendications $revendication): self
    {
        if ($this->revendications->removeElement($revendication)) {
            // set the owning side to null (unless already changed)
            if ($revendication->getRequete() === $this) {
                $revendication->setRequete(null);
            }
        }

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->date_depot;
    }

    public function setDateDepot(\DateTimeInterface $date_depot): self
    {
        $this->date_depot = $date_depot;

        return $this;
    }

    public function getDateTraite(): ?\DateTimeInterface
    {
        return $this->date_traite;
    }

    public function setDateTraite(\DateTimeInterface $date_traite): self
    {
        $this->date_traite = $date_traite;

        return $this;
    }
}
