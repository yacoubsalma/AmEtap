<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[UniqueEntity(fields: ['matricule', 'evenement'], message: 'Ce matricule existe déjà pour cet événement.')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idr = null;

    #[Assert\NotBlank(message: "Veuillez saisir le nom.")]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Assert\NotBlank(message: "Veuillez saisir le prénom.")]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[Assert\NotBlank(message: "Veuillez saisir le matricule.")]
    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: "Veuillez entrer une adresse email valide.")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9._%+-]+\\.[a-zA-Z0-9._%+-]+@etap\\.tn.com$/",
        message: "L'adresse email doit suivre le format nom.prenom@etap.tn.com"
    )]
    private ?string $adresse = null;

    #[Assert\NotBlank(message: "Veuillez saisir le numéro.")]
    #[ORM\Column]
    private ?int $num = null;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(name: 'ide', referencedColumnName: 'ide')]
    private ?Evenement $evenement = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $customData = [];

    public function getIdr(): ?int
    {
        return $this->idr;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): static
    {
        $this->num = $num;
        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }
    
    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;
        return $this;
    }

    public function getCustomData(): array
    {
        return $this->customData;
    }

    public function setCustomData(array $customData): self
    {
        $this->customData = $customData;

        return $this;
    }
}
