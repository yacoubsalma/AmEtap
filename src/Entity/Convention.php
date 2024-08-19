<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ConventionRepository;

#[ORM\Entity(repositoryClass: ConventionRepository::class)]
class Convention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idc = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $pdfFile = null;

    // Getters and Setters
    public function getIdc(): ?int
    {
        return $this->idc;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
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

    public function getPdfFile(): ?string
    {
        return $this->pdfFile;
    }

    public function setPdfFile(string $pdfFile): self
    {
        $this->pdfFile = $pdfFile;
        return $this;
    }
}
