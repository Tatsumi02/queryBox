<?php

namespace App\Entity;

use App\Repository\RevendicationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RevendicationsRepository::class)]
class Revendications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $objet;

    #[ORM\Column(type: 'text')]
    private $message;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $etat;

    #[ORM\Column(type: 'string', length: 255)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: Etudiants::class, inversedBy: 'revendications')]
    #[ORM\JoinColumn(nullable: false)]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: Requetes::class, inversedBy: 'revendications')]
    #[ORM\JoinColumn(nullable: false)]
    private $requete;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function setStatut(string $statut): self
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

    public function getRequete(): ?Requetes
    {
        return $this->requete;
    }

    public function setRequete(?Requetes $requete): self
    {
        $this->requete = $requete;

        return $this;
    }
}
