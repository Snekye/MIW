<?php

namespace App\Entity;

use App\Repository\AccueilActualiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Cocur\Slugify\Slugify;

#[ORM\Entity(repositoryClass: AccueilActualiteRepository::class)]
class AccueilActualite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_slug = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    public function __construct() 
    {
        $this->date = new \DateTime('now');
    }



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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = new Image();
        $this->image->setLien('img/upload/AccueilActualite/'.$image);

        return $this;
    }

}
