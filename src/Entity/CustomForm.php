<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\CustomFormRepository')]
class CustomForm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: 'customForms')]
    #[ORM\JoinColumn(name: 'evenement_id', referencedColumnName: 'ide', nullable: false)]
    private ?Evenement $evenement = null;

   

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $fieldLabel = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $fieldType = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $customData = [];

    public function getId(): ?int
    {
        return $this->id;
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

   

    public function getFieldLabel(): ?string
    {
        return $this->fieldLabel;
    }

    public function setFieldLabel(string $fieldLabel): static
    {
        $this->fieldLabel = $fieldLabel;
        return $this;
    }

    public function getFieldType(): ?string
    {
        return $this->fieldType;
    }

    public function setFieldType(string $fieldType): static
    {
        $this->fieldType = $fieldType;
        return $this;
    }

    public function getCustomData(): ?array
    {
        return $this->customData;
    }

    public function setCustomData(?array $customData): self
    {
        $this->customData = $customData;
        return $this;
    }
}
