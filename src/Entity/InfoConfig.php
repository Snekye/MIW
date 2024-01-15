<?php

namespace App\Entity;

use App\Repository\GlobalInfoConfigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalInfoConfigRepository::class)]
class InfoConfig
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $agence_adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $agence_tel = null;

    #[ORM\Column(length: 255)]
    private ?string $siege_adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $siege_tel = null;

    #[ORM\Column(length: 255)]
    private ?string $horaires = null;

    #[ORM\Column(length: 255)]
    private ?string $site_titre = null;

    #[ORM\Column(length: 255)]
    private ?string $site_metadescription = null;

    #[ORM\Column(length: 255)]
    private ?string $site_visibilite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAgenceAdresse(): ?string
    {
        return $this->agence_adresse;
    }

    public function setAgenceAdresse(string $agence_adresse): static
    {
        $this->agence_adresse = $agence_adresse;

        return $this;
    }

    public function getAgenceTel(): ?string
    {
        return $this->agence_tel;
    }

    public function setAgenceTel(string $agence_tel): static
    {
        $this->agence_tel = $agence_tel;

        return $this;
    }

    public function getSiegeAdresse(): ?string
    {
        return $this->siege_adresse;
    }

    public function setSiegeAdresse(string $siege_adresse): static
    {
        $this->siege_adresse = $siege_adresse;

        return $this;
    }

    public function getSiegeTel(): ?string
    {
        return $this->siege_tel;
    }

    public function setSiegeTel(string $siege_tel): static
    {
        $this->siege_tel = $siege_tel;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): static
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getSiteTitre(): ?string
    {
        return $this->site_titre;
    }

    public function setSiteTitre(string $site_titre): static
    {
        $this->site_titre = $site_titre;

        return $this;
    }

    public function getSiteMetadescription(): ?string
    {
        return $this->site_metadescription;
    }

    public function setSiteMetadescription(string $site_metadescription): static
    {
        $this->site_metadescription = $site_metadescription;

        return $this;
    }

    public function getSiteVisibilite(): ?string
    {
        return $this->site_visibilite;
    }

    public function setSiteVisibilite(string $site_visibilite): static
    {
        $this->site_visibilite = $site_visibilite;

        return $this;
    }
}
