<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Cocur\Slugify\Slugify;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Image $image = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdminLog $_created = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $slugify = new Slugify();

        $this->titre = $titre;
        $this->titre_slug = $slugify->slugify($titre);
        return $this;
    }

    public function getTitreSlug(): ?string
    {
        return $this->titre_slug;
    }

    public function setTitreSlug(string $titre_slug): static
    {
        $this->titre_slug = $titre_slug;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = new Image();
        $this->image->setLien($image);

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
        return $this->titre;
    }

}
