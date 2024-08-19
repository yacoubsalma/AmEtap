<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\SuggestionRepository;


#[ORM\Entity(repositoryClass:SuggestionRepository::class)]
class Suggestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $ids = null;


    #[ORM\Column(length:255)]
    private ?string $msg=null;
  
    

    public function getIds(): ?int
    {
        return $this->ids;
    }

    public function getMsg(): ?string
    {
        return $this->msg;
    }

    public function setMsg(string $msg): static
    {
        $this->msg = $msg;

        return $this;
    }


}
