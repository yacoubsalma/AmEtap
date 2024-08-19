<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EvenementRepository;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $ide = null;

    #[Assert\NotBlank(message: "Veuillez saisir le nom.")]
    #[ORM\Column(name: 'nomE', length: 255)]
    private ?string $nome = null; // Mise à jour du nom de propriété pour `nomE`

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    #[Assert\NotBlank(message: "Veuillez insérer une date.")]
    #[ORM\Column(name: 'dateD', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateD = null;

    #[Assert\NotBlank(message: "Veuillez insérer une date.")]
    #[ORM\Column(name: 'dateF', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateF = null;

    #[Assert\NotBlank(message: "Veuillez insérer le lieu.")]
    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[Assert\NotBlank(message: "Veuillez insérer une description courte.")]
    #[ORM\Column(name: 'ShortD', length: 160)]
    private ?string $ShortD = null;

    #[Assert\NotBlank(message: "Veuillez insérer une description longue.")]
    #[ORM\Column(name: 'LongD', length: 300)]
    private ?string $LongD = null;

    #[Assert\NotBlank(message: "Veuillez insérer la somme.")]
    #[ORM\Column(name: 'sommeA', type: Types::INTEGER)]
    private ?int $sommeA = null;

    #[ORM\OneToMany(targetEntity: CustomForm::class, mappedBy: 'evenement')]
    private Collection $customForms;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'evenement')]
private Collection $reservations;

    public function __construct()
    {
        $this->customForms = new ArrayCollection();
    }

    public function getIde(): ?int
    {
        return $this->ide;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;
        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;
        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): static
    {
        $this->dateD = $dateD;
        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): static
    {
        $this->dateF = $dateF;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getShortD(): ?string
    {
        return $this->ShortD;
    }

    public function setShortD(string $ShortD): static
    {
        $this->ShortD = $ShortD;
        return $this;
    }

    public function getLongD(): ?string
    {
        return $this->LongD;
    }

    public function setLongD(string $LongD): static
    {
        $this->LongD = $LongD;
        return $this;
    }

    public function getSommeA(): ?int
    {
        return $this->sommeA;
    }

    public function setSommeA(int $sommeA): static
    {
        $this->sommeA = $sommeA;
        return $this;
    }

    // Methods for customForms
    public function getCustomForms(): Collection
    {
        return $this->customForms;
    }

    public function addCustomForm(CustomForm $customForm): static
    {
        if (!$this->customForms->contains($customForm)) {
            $this->customForms[] = $customForm;
            $customForm->setEvenement($this);
        }

        return $this;
    }

    public function removeCustomForm(CustomForm $customForm): static
    {
        if ($this->customForms->removeElement($customForm)) {
            // set the owning side to null (unless already changed)
            if ($customForm->getEvenement() === $this) {
                $customForm->setEvenement(null);
            }
        }

        return $this;
    }
}
