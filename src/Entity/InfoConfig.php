<?php

namespace App\Entity;

use App\Repository\InfoConfigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoConfigRepository::class)]
class InfoConfig
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdminLog $_created = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?AdminLog $_updated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLib(): ?string
    {
        return $this->lib;
    }

    public function setLib(string $lib): static
    {
        $this->lib = $lib;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getCreated(): ?AdminLog
    {
        return $this->_created;
    }

    public function setCreated(AdminLog $_created): static
    {
        $this->_created = $_created;

        return $this;
    }

    public function getUpdated(): ?AdminLog
    {
        return $this->_updated;
    }

    public function setUpdated(?AdminLog $_updated): static
    {
        $this->_updated = $_updated;

        return $this;
    }



    public function __toString(): string
    {
        return $this->lib;
    }
}
