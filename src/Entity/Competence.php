<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Cocur\Slugify\Slugify;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\OneToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdminLog $_created = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?AdminLog $_updated = null;



    #[Vich\UploadableField(mapping: 'skill', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;





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



public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }




    
    public function __toString(): string
    {
        return $this->titre;
    }

}
